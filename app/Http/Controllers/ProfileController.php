<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $collaborator = User::with('userDetails')->findorFail(auth()->id()); 

        return view('user.profile', compact('collaborator'));
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

    public function updateUserData(Request $request)
    {
        //form validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
        ]);

        $user = auth()->user();

        //atualizando os dados do usuário
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('success_change_data', 'Dados do usuário atualizados com sucesso.');
    }

    public function updateUserAddress(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|min:2|max:100',
            'city' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'zip_code' => 'required|string|max:10',
        ]);

        $user = auth()->user();
        $userDetails = $user->userDetails()->firstOrNew();

        $userDetails->address = $validated['address'];
        $userDetails->city = $validated['city'];
        $userDetails->phone = $validated['phone'];
        $userDetails->zip_code = $validated['zip_code'];
        $userDetails->save();

        return redirect()->back()->with('success_change_address', 'Endereço do usuário atualizado com sucesso.');
    }
 
}
