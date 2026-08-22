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
    

    Route::get('/departments/{department}/edit', [DepartmentController::class, 'edit'])->name('department.edit-department');
    Route::put('/departments/{department}/update', [DepartmentController::class, 'update'])->name('department.update-department');
   

    Route::get('/departments/{department}/delete', [DepartmentController::class, 'destroy'])->name('department.delete-department');
    Route::get('/departments/{department}/delete-confirm', [DepartmentController::class, 'deleteDepartmentConfirm'])->name('department.delete-department-confirm');


    Route::get('/rh-users', [App\Http\Controllers\RHUserController::class, 'index'])->name('colaborators.rh-users');
    Route::get('/rh-users/new-colaborator', [App\Http\Controllers\RHUserController::class, 'newColaborator'])->name('colaborators.new-colaborator');

    //Rota para criar um novo colaborador
    Route::post('/rh-users/create-colaborator', [App\Http\Controllers\RHUserController::class, 'createColaborator'])->name('colaborators.create-colaborator');

    //Rota para editar um colaborador RH
    Route::get('/rh-users/{id}/edit', [App\Http\Controllers\RHUserController::class, 'editColaborator'])->name('colaborators.edit-colaborator');
    Route::post('/rh-users/update', [App\Http\Controllers\RHUserController::class, 'updateColaborator'])->name('colaborators.update-colaborator');

    //Rota para deletar um colaborador RH
    Route::get('/rh-users/{id}/delete-confirm', [App\Http\Controllers\RHUserController::class, 'deleteColaboratorConfirm'])->name('colaborators.delete-colaborator-confirm');
    Route::get('/rh-users/{id}/delete', [App\Http\Controllers\RHUserController::class, 'deleteColaborator'])->name('colaborators.delete-colaborator');
});
    