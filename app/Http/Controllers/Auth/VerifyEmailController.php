<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Cek apakah email sudah diverifikasi
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/home')->with('verified', true);
        }

        // Tandai email sebagai terverifikasi
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user())); // Kirim event bahwa email sudah diverifikasi
        }

        return redirect()->intended('/home')->with('verified', true);
    }
}
