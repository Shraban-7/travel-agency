<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $client = Auth::guard('client')->user();

        $applications = $client->applications()
            ->with(['statusLogs' => fn ($q) => $q->where('public_visible', true)->latest(), 'payments', 'schedules', 'documents'])
            ->latest()
            ->get();

        $totalFee = (float) $applications->sum('total_fee');
        $paidTotal = (float) $applications->sum('paid_amount');
        $dueTotal = (float) $applications->sum('due_amount');

        $payments = $client->payments()->with('application')->latest('paid_at')->latest()->get();

        $documents = collect();
        foreach ($applications as $application) {
            foreach ($application->documents as $document) {
                $document->setAttribute('application_tracking_code', $application->tracking_code);
                $documents->push($document);
            }
        }

        return view('account.dashboard', [
            'client' => $client,
            'applications' => $applications,
            'totalFee' => $totalFee,
            'paidTotal' => $paidTotal,
            'dueTotal' => $dueTotal,
            'payments' => $payments,
            'documents' => $documents,
        ]);
    }
}
