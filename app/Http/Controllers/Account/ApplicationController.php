<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function show(Application $application): View
    {
        $clientId = Auth::guard('client')->id();

        if ((int) $application->client_id !== (int) $clientId) {
            abort(404);
        }

        $application->load([
            'statusLogs' => fn ($q) => $q->where('public_visible', true)->latest(),
            'payments' => fn ($q) => $q->latest('paid_at')->latest(),
            'schedules',
            'documents',
            'country',
        ]);

        return view('account.applications.show', [
            'application' => $application,
            'client' => Auth::guard('client')->user(),
        ]);
    }
}
