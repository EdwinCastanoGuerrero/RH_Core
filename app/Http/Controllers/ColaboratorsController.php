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
        $colaborators = User::with('details')
            ->where('role', '<>', 'admin')
            ->get();
        return view('colaborators.admin-all-collaborators', compact('colaborators'));
    }
}
