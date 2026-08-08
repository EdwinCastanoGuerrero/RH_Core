<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RHUserController extends Controller
{
    public function index()
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');
        $users = User::where('role', 'rh')->get();
        return view('colaborators.rh-users', compact('users'));
    }

    public function newColaborator()
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');

        //obtendo todos os departamentos para exibir no select do formulário
        $departments = Department::all();
        return view('colaborators.add-rh-user', compact('departments'));
    }

    public function createColaborator(Request $request)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');

        //Validação dos dados do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'department_id' => 'required|exists:departments,id',
        ]);

        //Criação do novo colaborador
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'rh';
        $user->department_id = $request->department_id;
        $user->permissions = '["rh"]'; // Definindo a permissão como 'rh'
        $user->save();

        return redirect()->route('colaborators.rh-users')->with('success', 'New collaborator created successfully.');
    }
}
