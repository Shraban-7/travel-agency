<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangeApplicationStatusRequest;
use App\Http\Requests\Admin\StorePaymentRequest;
use App\Models\Application;
use App\Models\Payment;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $applications = Application::with('client')
            ->when($request->filled('search'), function ($q) use ($request) {
                $s = '%'.$request->input('search').'%';
                $q->where('tracking_code', 'like', $s)
                    ->orWhereHas('client', fn ($w) => $w->where('full_name', 'like', $s)->orWhere('phone', 'like', $s));
            })
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->input('status')))
            ->when($request->filled('service_type'), fn ($q) => $q->where('service_type', $request->input('service_type')))
            ->latest('updated_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.applications.index', compact('applications'));
    }

    public function show(Application $application)
    {
        $application->load(['client', 'assignee', 'country', 'documents', 'payments' => fn ($q) => $q->latest(), 'statusLogs' => fn ($q) => $q->latest()->with('changer')]);

        $paidSum = (float) $application->payments()->sum('amount');
        $due = max(0, (float) $application->total_fee - $paidSum);

        return view('admin.applications.show', compact('application', 'paidSum', 'due'));
    }

    public function changeStatus(ChangeApplicationStatusRequest $request, Application $application)
    {
        $data = $request->validated();

        $application->statusLogs()->create([
            'from_status' => $application->status,
            'to_status' => $data['to_status'],
            'note' => $data['note'] ?? null,
            'public_visible' => $request->boolean('public_visible'),
            'changed_by' => auth()->id(),
        ]);

        $application->update([
            'status' => $data['to_status'],
            'public_note' => $data['note'] ?? $application->public_note,
            'closed_at' => in_array($data['to_status'], ['completed', 'cancelled', 'rejected']) ? now() : null,
        ]);

        activity()
            ->performedOn($application)
            ->causedBy(auth()->user())
            ->withProperties(['from' => $application->getOriginal('status'), 'to' => $data['to_status']])
            ->log('Application status changed to '.$data['to_status']);

        return back()->with('success', __('Application status updated.'));
    }

    public function storePayment(StorePaymentRequest $request, Application $application)
    {
        $data = $request->validated();

        $year = now()->format('Y');
        $last = Payment::where('receipt_no', 'like', "R-{$year}-%")->orderByDesc('receipt_no')->first();
        $next = $last ? ((int) substr($last->receipt_no, -6)) + 1 : 1;
        $receiptNo = sprintf('R-%s-%06d', $year, $next);

        $payment = $application->payments()->create([
            'client_id' => $application->client_id,
            'amount' => $data['amount'],
            'method' => $data['method'],
            'reference_no' => $data['reference_no'] ?? null,
            'paid_at' => $data['paid_at'] ?? now(),
            'type' => $data['type'] ?? 'installment',
            'receipt_no' => $receiptNo,
            'received_by' => auth()->id(),
            'note' => $data['note'] ?? null,
        ]);

        activity()
            ->performedOn($application)
            ->causedBy(auth()->user())
            ->withProperties(['receipt_no' => $receiptNo, 'amount' => $data['amount'], 'method' => $data['method'], 'payment_id' => $payment->id])
            ->log('Payment recorded: '.$receiptNo);

        $paidSum = (float) $application->payments()->sum('amount');
        $application->update([
            'paid_amount' => $paidSum,
            'due_amount' => max(0, (float) $application->total_fee - $paidSum),
        ]);

        return back()->with('success', __('Payment recorded: :receipt', ['receipt' => $receiptNo]));
    }
}
