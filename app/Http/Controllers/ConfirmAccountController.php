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
        $user = User::where('confirmation_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Link de confirmação inválido ou já utilizado.');
        }

        return view('auth.confirm-account', compact('token'));
    }

    public function storePassword(Request $request, $token)
    {
        $user = User::where('confirmation_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Link de confirmação inválido ou já utilizado.');
        }

        $request->validate([
            'password' => ['required', 'string', Password::default(), 'confirmed'],
        ]);

        $user->password = Hash::make($request->password);
        $user->confirmation_token = null;
        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('login')->with('status', 'Conta confirmada com sucesso! Já pode iniciar sessão.');
    }
}
