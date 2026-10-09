<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLeadNoteRequest;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $leads = Lead::with('assignee')
            ->when($request->filled('search'), function ($q) use ($request) {
                $s = '%'.$request->input('search').'%';
                $q->where(fn ($w) => $w->where('name', 'like', $s)->orWhere('phone', 'like', $s));
            })
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->input('status')))
            ->when($request->filled('service'), fn ($q) => $q->where('service_type', $request->input('service')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.leads.index', compact('leads'));
    }

    public function show(Lead $lead)
    {
        $lead->load(['notes.user', 'assignee', 'interestedCountry', 'client']);

        return view('admin.leads.show', compact('lead'));
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,contacted,qualified,converted,lost'],
        ]);

        $lead->update(['status' => $validated['status']]);

        activity()
            ->performedOn($lead)
            ->causedBy(auth()->user())
            ->withProperties(['status' => $validated['status']])
            ->log('Lead status changed to '.$validated['status']);

        return back()->with('success', __('Lead status updated.'));
    }

    public function storeNote(StoreLeadNoteRequest $request, Lead $lead)
    {
        $lead->notes()->create([
            'user_id' => auth()->id(),
            'note' => $request->validated()['note'],
        ]);

        activity()
            ->performedOn($lead)
            ->causedBy(auth()->user())
            ->withProperties(['note' => $request->validated()['note']])
            ->log('Note added to lead');

        return back()->with('success', __('Note added.'));
    }
}
