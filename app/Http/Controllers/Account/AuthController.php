<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showRegister(): View
    {
        return view('account.register');
    }

    public function showLogin(): View
    {
        return view('account.login');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:150'],
            'phone' => ['required', 'string', 'min:6', 'max:20', 'unique:clients,phone'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'full_name.required' => 'অনুগ্রহ করে আপনার নাম লিখুন।',
            'phone.required' => 'অনুগ্রহ করে মোবাইল নম্বর দিন।',
            'phone.unique' => 'এই মোবাইল নম্বর দিয়ে ইতিমধ্যে অ্যাকাউন্ট রয়েছে। অনুগ্রহ করে লগইন করুন।',
            'password.required' => 'অনুগ্রহ করে পাসওয়ার্ড দিন।',
            'password.min' => 'পাসওয়ার্ড কমপক্ষে ৮ অক্ষরের হতে হবে।',
            'password.confirmed' => 'পাসওয়ার্ড নিশ্চিতকরণ মিলছে না।',
        ]);

        $phone = $this->normalizePhone($validated['phone']);

        // Re-check uniqueness on normalized phone
        if (Client::where('phone', $phone)->exists()) {
            return back()->withErrors(['phone' => 'এই মোবাইল নম্বর দিয়ে ইতিমধ্যে অ্যাকাউন্ট রয়েছে। অনুগ্রহ করে লগইন করুন।'])->withInput();
        }

        $client = Client::create([
            'full_name' => $validated['full_name'],
            'phone' => $phone,
            'password' => $validated['password'],
        ]);

        Auth::guard('client')->login($client);
        $request->session()->regenerate();

        return redirect()->route('account.dashboard')->with('success', 'স্বাগতম! আপনার অ্যাকাউন্ট তৈরি হয়েছে।');
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'phone' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'phone.required' => 'অনুগ্রহ করে মোবাইল নম্বর দিন।',
            'password.required' => 'অনুগ্রহ করে পাসওয়ার্ড দিন।',
        ]);

        $phone = $this->normalizePhone($validated['phone']);

        if (Auth::guard('client')->attempt(['phone' => $phone, 'password' => $validated['password']], $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('account.dashboard'))->with('success', 'স্বাগতম! সফলভাবে লগইন হয়েছে।');
        }

        return back()->withErrors(['phone' => 'মোবাইল নম্বর বা পাসওয়ার্ড সঠিক নয়।'])->withInput($request->only('phone'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('account.login')->with('success', 'সফলভাবে লগআউট হয়েছে।');
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
