<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RHUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_rh_colaborator(): void
    {
        Department::create(['id' => 2, 'name' => 'Recursos Humanos']);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('secret123'),
            'role' => 'admin',
            'department_id' => 2,
            'permissions' => json_encode(['admin']),
        ]);

        $response = $this->actingAs($admin)->post(route('colaborators.rh.create-colaborator'), [
            'name' => 'banana',
            'email' => 'banana@gmail.com',
            'department_id' => 2,
            'address' => 'Rua Teste',
            'zip_code' => '12345-678',
            'city' => 'São Paulo',
            'phone' => '11999999999',
            'salary' => 2500.00,
            'admission_date' => '2026-08-31',
        ]);

        $response->assertRedirect(route('colaborators.rh-users'));
        $this->assertDatabaseHas('users', [
            'email' => 'banana@gmail.com',
            'role' => 'rh',
        ]);
        $this->assertDatabaseHas('user_details', [
            'phone' => '11999999999',
        ]);
    }
}
