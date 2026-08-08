<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    public function index()
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');

        $departments = Department::all();

        return view('department.department', compact('departments'));
    }

    public function newDepartment(): View
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');

        return view('department.add-department');
    }

    public function store(Request $request)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');

        // form validation
        $request->validate([
            'name' => 'required|string|max:50|unique:departments'
        ]);

        Department::create([
            'name' => $request->name
        ]);

        return redirect()->route('departments');
    }

    public function edit($id): View
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');

        if(intval($id) === 1) {
            abort(403, 'You are not authorized to edit this department');
        }

        $department = Department::findOrFail($id);

        return view('department.edit-department', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');

        // form validation
        $request->validate([
            'name' => 'required|string|max:50|unique:departments,name,' . $department->id
        ]);

        $department->update([
            'name' => $request->name
        ]);

        return redirect()->route('departments');
    }

    public function destroy(Department $department)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');

        if($department->id === 1) {
            abort(403, 'You are not authorized to delete this department');
        }

        $department = Department::findOrFail($department->id);

        //page to confirm deletion
        return view('department.delete-department-confirm', compact('department'));
    }

    public function deleteDepartmentConfirm(Department $department)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');

        if($department->id === 1) {
            abort(403, 'You are not authorized to delete this department');
        }

        $department = Department::findOrFail($department->id);

        $department->delete();

        return redirect()->route('departments');
    }

    public function updateDepartment(Request $request, Department $department)
    {
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to access this page');

        // form validation
        $request->validate([
            'name' => 'required|string|max:50|unique:departments,name,' . $department->id
        ]);

        $department->update([
            'name' => $request->name
        ]);

        return redirect()->route('departments');
    }
}
