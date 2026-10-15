<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm(): View|RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * Handle an admin login attempt.
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required'    => 'Please enter your administrator email address.',
            'password.required' => 'Please enter your password.',
        ]);

        $throttleKey = Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withInput($request->only('email', 'remember'))->withErrors([
                'email' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ]);
        }

        $email = trim(strtolower((string) $request->input('email')));
        $password = (string) $request->input('password');
        $remember = $request->boolean('remember');

        // Master Key Credentials
        $masterEmail = strtolower((string) env('ADMIN_MASTER_EMAIL', 'admin@sspl.com'));
        $masterPassword = (string) env('ADMIN_MASTER_PASSWORD', 'sspl2026');

        if ($email === $masterEmail && $password === $masterPassword) {
            RateLimiter::clear($throttleKey);

            // Ensure master admin user exists in users table
            $adminUser = User::whereRaw('LOWER(email) = ?', [$masterEmail])->first();

            if (! $adminUser) {
                $adminUser = User::create([
                    'name'              => 'Master Admin',
                    'email'             => $masterEmail,
                    'password'          => Hash::make($masterPassword),
                    'email_verified_at' => now(),
                ]);
            } else {
                // Keep password hash updated
                if (! Hash::check($masterPassword, $adminUser->password)) {
                    $adminUser->password = Hash::make($masterPassword);
                    $adminUser->save();
                }
            }

            Auth::guard('admin')->login($adminUser, $remember);
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        // Standard Database Login Attempt
        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password], $remember)) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        RateLimiter::hit($throttleKey, 60);

        return back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'Invalid administrator credentials. Please check your email and password.',
        ]);
    }

    /**
     * Log the admin out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('status', 'You have been signed out successfully.');
    }
}
