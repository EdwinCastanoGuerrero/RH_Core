<?php

use App\Models\User;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


 Route::get('/', function () {
    echo 'App is running!';
});


Route::get('/email', function () {
    Mail::raw('Teste de email', function (Message $message) {
        $message->to('teste@example.com')
                ->subject('Teste Email')
                ->from('rh@example.com');
    });
    echo 'Email enviado com sucesso!';
});

Route::get('/admin', function () {
    $admin = User::with('userDetails', 'department')->find(1);
    return view('admin', compact('admin'));
});
