<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        Auth::user()->can('admin') ?: abort(403, 'you are not authorized to access this page');

        //obter informações gerais do sistema, como número de colaboradores, departamentos, etc.

        $data = [];

        //obter o número de colaboradores
        $data['colaborators_count'] = User::withoutTrashed()->count();

        //obter o número de colaboradores inativos
        $data['inactive_colaborators_count'] = User::onlyTrashed()->count();

        //obter o salário total dos colaboradores ativos
        $salarySum = User::withoutTrashed()->with('userDetails')->get()->sum(function ($user) {
            return $user->userDetails->salary ?? 0;
        });
        $data['total_salary'] = $salarySum;

        //total de colaboradores por departamento
        $data['colaborators_by_department'] = User::withoutTrashed()->with('department')->get()->groupBy('department.name')->map(function ($colaborators, $departmentName) {
            return [
                'department' => $departmentName ?? 'N/A',
                'colaborators_count' => $colaborators->count(),
            ];
        })->values();


        //total de salario por departamento

        $data['salary_by_department'] = User::withoutTrashed()->with('department', 'userDetails')->get()->groupBy('department.name')->map(function ($colaborators, $departmentName) {
            $totalSalary = $colaborators->sum(function ($user) {
                return $user->userDetails->salary ?? 0;
            });
            return [
                'department' => $departmentName ?? 'N/A',
                'total_salary' => $totalSalary,
            ];
        })->values();

        //obter o número de departamentos
        $data['departments_count'] = User::withoutTrashed()->with('department')->get()->pluck('department')->unique('id')->count();


        //mostra a página de administração apenas se o usuário tiver permissão de admin
        return view('home', compact('data'));
    }
}
