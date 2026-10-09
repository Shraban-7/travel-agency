<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InquiryController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'phone' => ['required', 'string', 'min:6', 'max:20'],
            'service' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'message' => ['nullable', 'string', 'max:2000'],
            'source' => ['nullable', 'in:web_form,contact'],
        ], [
            'name.required' => 'অনুগ্রহ করে আপনার নাম লিখুন।',
            'phone.required' => 'অনুগ্রহ করে সঠিক মোবাইল নম্বর দিন।',
        ]);

        $phone = $this->normalizePhone($validated['phone']);
        $countryInput = trim($validated['country'] ?? '');
        $countryId = null;

        if (is_numeric($countryInput)) {
            $countryId = Country::whereKey($countryInput)->value('id');
        } elseif ($countryInput !== '') {
            $countryId = Country::where('slug', Str::slug($countryInput))->value('id');
        }

        $message = trim($validated['message'] ?? '');
        if ($countryInput !== '' && ! $countryId) {
            $message = trim($message."\nআগ্রহের দেশ: ".$countryInput);
        }

        Lead::create([
            'name' => $validated['name'],
            'phone' => $phone,
            'service_type' => $validated['service'] ?? 'other',
            'interested_country_id' => $countryId,
            'message' => $message ?: null,
            'source' => $validated['source'] ?? 'web_form',
            'status' => 'new',
            'ip' => $request->ip(),
        ]);

        return back()->with('success', 'ধন্যবাদ! আপনার অনুরোধ পেয়েছি — ৩০ মিনিটের মধ্যে আমাদের প্রতিনিধি কল করবেন ইনশাআল্লাহ।');
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
