<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RhManagementController extends Controller
{
    public function index()
    {
        Auth::user()->can('rh') ?: abort(403, 'You are not authorized to access this page');

        //trazendo todos os colaboradores

        $colaborators = User::with('detail', 'department')
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
}
