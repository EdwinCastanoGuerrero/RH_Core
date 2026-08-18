<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'department_id' => 'required|exists:departments,id',
            'address' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'salary' => 'nullable|numeric|min:0',
            'admission_date' => 'nullable|date_format:Y-m-d',
        ]);

        $defaultPassword = 'Rh@' . Str::upper(Str::random(6));

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($defaultPassword),
            'role' => 'rh',
            'department_id' => $request->department_id,
            'permissions' => '["rh"]',
        ]);

        $user->userDetails()->create([
            'address' => $request->filled('address') ? $request->address : null,
            'zip_code' => $request->filled('zip_code') ? $request->zip_code : null,
            'city' => $request->filled('city') ? $request->city : null,
            'phone' => $request->filled('phone') ? $request->phone : null,
            'salary' => $request->filled('salary') ? $request->salary : null,
            'admission_date' => $request->filled('admission_date') ? $request->admission_date : null,
            'user_id' => $user->id,
        ]);

        return redirect()->route('colaborators.rh-users')->with('success', 'New collaborator created successfully.');
    }
}
