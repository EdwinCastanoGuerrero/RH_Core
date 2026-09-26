<?php

use App\Http\Controllers\ConfirmAccountController;
use App\Models\User;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

//Middleware: encaminha para rota de login caso o usuário não esteja autenticado
Route::middleware('auth')->group(function(){
    Route::redirect('/', '/home');
    Route::get('/home', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.home');
        } elseif (auth()->user()->role === 'rh') {
            return redirect()->route('rh-management.index');
        } else {
            return redirect()->route('user.profile');
        }
    })->name('home');

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
    Route::get('/rh-users/new-colaborator', [App\Http\Controllers\RHUserController::class, 'newColaborator'])->name('colaborators.rh.new-colaborator');

    //Rota para criar um novo colaborador RH
    Route::post('/rh-users/create-colaborator', [App\Http\Controllers\RHUserController::class, 'createColaborator'])->name('colaborators.rh.create-colaborator');

    //Rota para editar um colaborador RH
    Route::get('/rh-users/{id}/edit', [App\Http\Controllers\RHUserController::class, 'editColaborator'])->name('colaborators.rh.edit-colaborator');
    Route::post('/rh-users/update', [App\Http\Controllers\RHUserController::class, 'updateColaborator'])->name('colaborators.rh.update-colaborator');

    //Rota para deletar um colaborador RH
    Route::get('/rh-users/{id}/delete-confirm', [App\Http\Controllers\RHUserController::class, 'deleteColaboratorConfirm'])->name('colaborators.rh.delete-colaborator-confirm');
    Route::get('/rh-users/{id}/delete', [App\Http\Controllers\RHUserController::class, 'deleteColaborator'])->name('colaborators.rh.delete-colaborator');
    //Rota para restaurar um colaborador RH
    Route::get('rh-users/restore/{id}', [App\Http\Controllers\RHUserController::class, 'restoreColaborator'])->name('colaborators.rh.restore');

   //rota para a página de administração
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');

     //Rota para a página inicial do RH Management
    Route::get('/rh-management/home', [App\Http\Controllers\RhManagementController::class, 'index'])->name('rh-management.index');
    Route::get('/rh-management/newCollaborator', [App\Http\Controllers\RhManagementController::class, 'newCollaborator'])->name('rh-management.newCollaborator');

    //Rota para listar todos os colaboradores RH
    Route::get('/colaborators', [App\Http\Controllers\ColaboratorsController::class, 'index'])->name('colaborators.all-colaborators');
    Route::get('/colaborators/details/{id}', [App\Http\Controllers\ColaboratorsController::class, 'show'])->name('colaborators.details');

    //Rota para deletar colaborador
    Route::get('/colaborators/delete/{id}', [App\Http\Controllers\ColaboratorsController::class, 'delete'])->name('colaborators.delete');
    Route::get('/colaborators/delete-confirm/{id}', [App\Http\Controllers\ColaboratorsController::class, 'deleteConfirm'])->name('colaborators.deleteConfirm');
    //Rota para restaurar um colaborador
    Route::get('/colaborators/restore/{id}', [App\Http\Controllers\ColaboratorsController::class, 'restore'])->name('colaborators.restore');
});

//Rota para confirmar a conta do usuário e definir a senha (acessível sem estar autenticado)
Route::get('/confirm-account/{token}', [ConfirmAccountController::class, 'confirmAccount'])->name('user.confirm-account');
Route::post('/confirm-account/{token}/set-password', [ConfirmAccountController::class, 'storePassword'])->name('user.set-password');

    