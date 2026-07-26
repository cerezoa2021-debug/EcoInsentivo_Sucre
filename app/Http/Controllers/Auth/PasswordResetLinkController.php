<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * Validates email and phone, then shows reset form if valid.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    { 
        $request->validate([
            'email' => ['required', 'email'],
            'telefono' => ['required', 'string'],
        ]);

        // Find user by email and verify phone matches
        $user = User::where('email', $request->email)->first();

        if (! $user || $user->telefono !== $request->telefono) {
            throw ValidationException::withMessages([
                'email' => ['El correo o teléfono no coinciden con nuestros registros.'],
            ]);
        }

        // Generate a reset token and store it in session
        $token = Str::random(64);
        \Illuminate\Support\Facades\DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );

        // Redirect to reset password form with token and email in session
        session(['reset_token' => $token, 'reset_email' => $user->email]);

        return redirect()->route('password.reset', ['token' => $token]);
    }
}
