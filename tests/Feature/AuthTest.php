<?php

use App\Models\User;

it('verifica o direcionamento do home para login, user Auth', function () {
    //verifica o contexto do fortify, se ao entrar na pagina inicial direciona para o login
    $result = $this->get('/')->assertRedirect(route('login'));

    //verificando se retorna 302, que é o código de redirecionamento
    // expect($result->status())->toBe(302);
    $result->assertStatus(302);

    //verificar se retorna 200
    // expect($this->get('login')->status())->toBe(200);
    expect($this->get('login')->assertStatus(200));
});

it('verifica a rota de reset de senha', function () {
    //verica a rota
    $result = $this->get('/forgot-password');
    expect($result->assertStatus(200));

    //verificando se no conteudo aparece a frase
    expect($result->content())->toContain("Enviar email");
});

it('verificação de usuário admin', function () {
    //criar um useradmin


    //criar um useradmin
    createAdminUser();

    //login com admin
    $result = $this->post('login', [
        'email' => 'admin@gmail.com',
        'password' => 'Aa123456'
    ]);

    //verifica se login está funcionando
    expect($result->status())->toBe(302); // Redirecionamento após login bem-sucedido
});

it('verifica o usuario RH', function () {
    //criar um user RH
    createRhUser();

    //login com RH
    $result = $this->post('login', [
        'email' => 'rh@gmail.com',
        'password' => 'Aa123456'
    ]);

    //verifica se login está funcionando
    expect($result->status())->toBe(302); // Redirecionamento após login bem-sucedido
    expect($this->get('/')->assertRedirect(route('home')));

    //verificando se user rh está acessando na rota esperada
    $homeResult = $this->get('/rh-management/home');
    expect($homeResult->assertStatus(200));
});


function createAdminUser()
{
    return User::create([
        'department_id' => 1,
        'name' => 'administrador',
        'email' => 'admin@gmail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('Aa123456'),
        'role' => 'admin',
        'permissions' => ['admin'],
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

function createRhUser()
{
    return User::create([
        'department_id' => 1,
        'name' => 'RH',
        'email' => 'rh@gmail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('Aa123456'),
        'role' => 'rh',
        'permissions' => ['rh'],
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}

function createRegularUser()
{
    return User::create([
        'department_id' => 1,
        'name' => 'Usuario',
        'email' => 'user@gmail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('Aa123456'),
        'role' => 'user',
        'permissions' => ['user'],
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}