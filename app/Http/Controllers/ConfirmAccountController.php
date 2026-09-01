<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfirmAccountController extends Controller
{   
    public function confirmAccount($token)
    {
        echo "Token: " . $token . "<br>";
        // $user = auth()->user();

        // if ($user->email_verified_at) {
        //     return redirect()->route('home')->with('message', 'Sua conta já foi confirmada.');
        // }

        // $user->email_verified_at = now();
        // $user->save();

        // return redirect()->route('home')->with('message', 'Conta confirmada com sucesso!');
    }
}
