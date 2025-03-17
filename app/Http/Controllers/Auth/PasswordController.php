<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', 'confirmed'],
        ], [
            'current_password.required' => 'Aktualne hasło jest wymagane.',
            'current_password.current_password' => 'Wprowadzone aktualne hasło jest nieprawidłowe.',
            'password.required' => 'Nowe hasło jest wymagane.',
            'password.confirmed' => 'Hasła nie zgadzają się.',
            'password.min' => 'Hasło musi mieć co najmniej 8 znaków.',
            'password.regex' => 'Hasło musi zawierać co najmniej jedną literę, jedną cyfrę i jeden znak specjalny.',
            'password.letters' => 'Hasło musi zawierać co najmniej jedną literę.',
            'password.numbers' => 'Hasło musi zawierać co najmniej jedną cyfrę.',
            'password_confirmation.required'=> "Potwierdzenie hasła jest wymagane."
            
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
