<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrackController extends Controller
{
    public function form(): View
    {
        return view('public.track');
    }

    public function result(Request $request): View
    {
        $validated = $request->validate([
            'phone' => ['required', 'string', 'min:6', 'max:20'],
            'tracking_code' => ['required', 'string', 'max:30'],
        ], [
            'phone.required' => 'মোবাইল নম্বর দিন।',
            'tracking_code.required' => 'ট্র্যাকিং কোড দিন।',
        ]);

        $code = strtoupper(trim($validated['tracking_code']));
        $phone = $this->normalizePhone($validated['phone']);

        // Accept a few stored formats so legit users are not locked out.
        $candidates = array_unique([
            $phone,
            '0'.ltrim(preg_replace('/\D+/', '', $phone), '880'),
            preg_replace('/\D+/', '', $phone),
        ]);

        $clientIds = Client::whereIn('phone', $candidates)->pluck('id');

        $application = Application::query()
            ->where('tracking_code', $code)
            ->whereIn('client_id', $clientIds)
            ->with([
                'client',
                'country',
                'statusLogs' => function ($q) {
                    $q->where('public_visible', true)->orderBy('created_at');
                },
            ])
            ->first();

        // Generic message either way — never reveal which field was wrong.
        if (! $application) {
            return view('public.track-result', [
                'application' => null,
                'error' => 'দুঃখিত, এই মোবাইল নম্বর ও ট্র্যাকিং কোডের সাথে মিলে এমন কোনো আবেদন পাওয়া যায়নি। নম্বর ও কোড আবার যাচাই করে চেষ্টা করুন।',
            ]);
        }

        return view('public.track-result', compact('application'));
    }

    protected function normalizePhone(string $phone): string
    {
        $digits = preg_replace('/\D+/', '', convertBengaliToEnglishDigits($phone) ?? '');

        if (str_starts_with($digits, '880')) {
            return '+'.$digits;
        }
        if (str_starts_with($digits, '0')) {
            return '+880'.ltrim($digits, '0');
        }
        if (strlen($digits) === 10) {
            return '+880'.$digits;
        }

        return '+'.$digits;
    }
}
