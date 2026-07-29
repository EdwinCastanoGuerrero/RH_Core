<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index()
    {   
        Auth::user()->can('viewAny', Department::class) || abort(403, 'Unauthorized action.');
        
        $departments = Department::all();
        return view('department.department', compact('departments'));
    }


}
