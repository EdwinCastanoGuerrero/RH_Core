<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RHUserController extends Controller
{
    public function index()
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');
        // $users = User::where('role', 'rh')->get();
        $users = User::where('role', 'rh')->with('userDetails')->get();
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

        if($request->department_id != 2) {
            return redirect()->route('home')->with('error', 'You can only create collaborators for the Human Resources department.');
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(bin2hex(random_bytes(16))),
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

    public function editColaborator($id)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');

        $user = User::with('userDetails')->where('id', $id)->where('role', 'rh')->firstOrFail();
        $departments = Department::all();
        return view('colaborators.edit-rh-user', compact('user', 'departments'));
    }

    public function updateColaborator(Request $request)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'department_id' => 'nullable|exists:departments,id',
            'address' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'salary' => 'nullable|numeric|min:0',
            'admission_date' => 'nullable|date_format:Y-m-d',
        ]);

        $user = User::findOrFail($request->user_id);

        if ($user->role !== 'rh') {
            return redirect()->route('colaborators.rh-users')->with('error', 'The specified user is not a collaborator.');
        }

        if ($request->filled('department_id')) {
            $user->update([
                'department_id' => $request->department_id,
            ]);
        }

        $user->userDetails()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'address' => $request->filled('address') ? $request->address : null,
                'zip_code' => $request->filled('zip_code') ? $request->zip_code : null,
                'city' => $request->filled('city') ? $request->city : null,
                'phone' => $request->filled('phone') ? $request->phone : null,
                'salary' => $request->filled('salary') ? $request->salary : null,
                'admission_date' => $request->filled('admission_date') ? $request->admission_date : null,
            ]
        );

        return redirect()->route('colaborators.rh-users')->with('success', 'Collaborator updated successfully.');
    }

    public function deleteColaboratorConfirm($id)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');

        $user = User::where('id', $id)->where('role', 'rh')->firstOrFail();
        return view('colaborators.delete-rh-user', compact('user'));
    }

    public function deleteColaborator($id)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');

        $user = User::where('id', $id)->where('role', 'rh')->firstOrFail();
        $user->delete();

        return redirect()->route('colaborators.rh-users')->with('success', 'Collaborator deleted successfully.');
    }
}
