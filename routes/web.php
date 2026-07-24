<?php

use App\Models\User;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

//Middleware: encaminha para rota de login caso o usuário não esteja autenticado
Route::middleware('auth')->group(function(){
    Route::redirect('/', '/home');
    Route::view('/home', 'home')->name('home');

});
