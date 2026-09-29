<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ConfirmAccountController extends Controller
{
    public function confirmAccount($token)
    {
        $user = User::where('confirmation_token', $token)
            ->where('confirmation_token_expires_at', '>', now())
            ->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Link de confirmação inválido ou já utilizado.');
        }

        return view('auth.confirm-account', ['token' => $token]);
    }

    public function storePassword(Request $request, $token)
    {
        $user = User::where('confirmation_token', $token)
            ->where('confirmation_token_expires_at', '>', now())
            ->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Link de confirmação inválido ou já utilizado.');
        }

        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->password = Hash::make($request->password);
        $user->confirmation_token = null;
        $user->confirmation_token_expires_at = null;
        $user->email_verified_at = now();
        $user->save();

        return view('auth.welcome', ['user' => $user]);
    }
}
