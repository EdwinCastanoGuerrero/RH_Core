<?php

use App\Models\User;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

//Middleware: encaminha para rota de login caso o usuário não esteja autenticado
Route::middleware('auth')->group(function(){
    Route::redirect('/', '/home');
    Route::view('/home', 'home')->name('home');

    //Rota para o perfil do usuário
    Route::get('/user/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::post('/user/profile/update-password', [ProfileController::class, 'updatePassword'])->name('user.profile.update-password');
    Route::post('/user/profile/update-user-data', [ProfileController::class, 'updateUserData'])->name('user.profile.update-user-data');

    //Rota para o departamento
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');
    // Route::get('/departments/{department}', [DepartmentController::class, 'show'])->name('departments.show');
    Route::get('/departments/add', [DepartmentController::class, 'newDepartment'])->name('department.add-department');
    Route::post('/departments/create', [DepartmentController::class, 'store'])->name('department.create-department');
    
});
