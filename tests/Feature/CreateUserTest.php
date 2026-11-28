<?php

use App\Models\User;
use App\Models\Department;


it('testas se o admin pode inserir um novo user rh', function () {

    //criar usuario admin
    createAdminUser();
    //criar os departamentos
    createDepartment('Administração');
    createDepartment('Rh');
    //acessar com o admin
    //login com RH
    $result = $this->post('login', [
        'email' => 'admin@gmail.com',
        'password' => 'Aa123456'
    ]);
    //verifica se login está funcionando
    expect($result->status())->toBe(302); // Redirecionamento após login bem-sucedido
    expect($this->get('/')->assertRedirect(route('home')));

    //verificar se admin consegue adicionar user rh
    expect($this->post('/rh-management/createCollaborator', [
        'name' => 'rh user 1',
        'email' => 'rh@gmail.com',
        'department_id' => 2,
        'adress' => 'rua 1',
        'zip_code' => '8606060',
        'city' => 'londres',
        'phone' => '890088990',
        'salary' => '10000.00',
        'admission_date' => '2022-02-10'
    ]));
    //user rh foi inserido com sucesso
    $this->assertDatabaseHas('users', [
        'name' => 'rh user 1',
        'email' => 'rh@gmail.com',
        'role' => 'rh',
        'permissions' => '["rh"]',
    ]);
});

function createDepartment($nome)
{
    return Department::created([
        'name' => $nome,
        'created_at' => now(),
        'updated_at' => now()
    ]);
};
