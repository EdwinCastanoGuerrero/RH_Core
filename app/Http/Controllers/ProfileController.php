<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('user.profile');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function updatePassword(Request $request)
    {
        //form validation
        $request->validate([
            'current_password' => 'required|min:8|max:16',
            'new_password' => 'required|min:8|max:16|different:current_password|confirmed',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        $user = auth()->user();

        //verificação da senha atual
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'A senha atual está incorreta.']);
        }
        

        //atualizando a senha do usuário
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Senha atualizada com sucesso.');
    }

 
}
