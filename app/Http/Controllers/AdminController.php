<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        Auth::user()->can('admin') ?: abort(403, 'you are not authorized to access this page');
        //mostra a página de administração apenas se o usuário tiver permissão de admin
        return view('home');
    }
}
