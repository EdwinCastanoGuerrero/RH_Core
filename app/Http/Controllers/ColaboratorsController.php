<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColaboratorsController extends Controller
{
    Public function index()
    {   
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');
        $colaborators = User::with('userDetails', 'department')
                        ->where('role', '<>', 'admin')
                        ->get();
        return view('colaborators.admin-all-collaborators', compact('colaborators'));
    }

    public function show($id)
    {
        Auth::user()->can('admin', 'rh') ?: abort(403, 'You are not authorized to access this page');

        //verifica se o id é o mesmo como o do usuário logado
        if (Auth::user()->id === $id) {
            return redirect()->route('home');
        }

        $colaborator = User::with('userDetails', 'department')
                        ->findOrFail($id);
        return view('colaborators.show-details', compact('colaborator'));
    }

    public function delete($id){
        Auth::user()->can('admin', 'rh') ?: abort(403, 'You are not authorized to access this page');

        if (Auth::user()->id === $id) {
            return redirect()->route('home');
        }

        $colaborator = User::findOrFail($id);

        return view('colaborators.delete-collaborator-confirm', compact('colaborator'));
    }

    public function deleteConfirm($id){
        Auth::user()->can('admin', 'rh') ?: abort(403, 'You are not authorized to access this page');

        if (Auth::user()->id === $id) {
            return redirect()->route('home');
        }

        $colaborator = User::findOrFail($id);

        $colaborator->delete();
        return redirect()->route('colaborators.all-colaborators');
    }    
}
