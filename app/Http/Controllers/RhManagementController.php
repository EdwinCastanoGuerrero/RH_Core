<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmAccountEmail;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RhManagementController extends Controller
{
    public function index()
    {
        Auth::user()->can('rh') ?: abort(403, 'You are not authorized to access this page');

        //trazendo todos os colaboradores

        $colaborators = User::with('userDetails', 'department')
                        ->where('role', 'colaborator')
                        ->withTrashed()
                        ->get();
        return view('colaborators.colaborators', compact('colaborators'));
    }

    public function newCollaborator()
    {
        Auth::user()->can('rh') ?: abort(403, 'You are not authorized to access this page');

        $departments = Department::where('id', '>', 2)->get();

        //se não houver departamentos cadastrados, redireciona para a página de cadastro de departamento
        if ($departments->isEmpty()) {
            abort(403, 'You need to create a department before creating a collaborator. Please contact your administrator.');
        }   

        return view('colaborators.new-colaborator', compact('departments'));
    }

    
    public function createCollaborator(Request $request){
        Auth::user()->can('rh') ?: abort(403, 'You are not authorized to access this page');

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

        if($request->department_id <= 2) {
            return redirect()->route('home')->with('error', 'You can only create collaborators for the Human Resources department.');
        }


        //criação do token
        $token = Str::random(60);


        //criando usuario (sem senha, ela será definida pelo próprio colaborador via e-mail de confirmação)
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 'colaborator';
        $user->department_id = $request->department_id;
        $user->permissions = json_encode(['colaborator']);
        $user->confirmation_token = $token;
        $user->confirmation_token_expires_at = now()->addDay();
        $user->save();

        $user->userDetails()->create([
            'address' => $request->filled('address') ? $request->address : null,
            'zip_code' => $request->filled('zip_code') ? $request->zip_code : null,
            'city' => $request->filled('city') ? $request->city : null,
            'phone' => $request->filled('phone') ? $request->phone : null,
            'salary' => $request->filled('salary') ? $request->salary : null,
            'admission_date' => $request->filled('admission_date') ? $request->admission_date : null,
            'user_id' => $user->id,
        ]);

        //envio de email de confirmação de conta
        
        Mail::to($user->email)->send(new ConfirmAccountEmail(route('user.confirm-account', $token)));

        return redirect()->route('rh-management.index')->with('success', 'New collaborator created successfully.');
    }
}
