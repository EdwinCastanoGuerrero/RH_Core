<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->updateOrInsert(
            ['name' => 'Administração'],
            ['created_at' => now(), 'updated_at' => now()]
        );
        $adminDepartmentId = DB::table('departments')->where('name', 'Administração')->value('id');

        DB::table('departments')->updateOrInsert(
            ['name' => 'Recursos Humanos'],
            ['created_at' => now(), 'updated_at' => now()]
        );
        $rhDepartmentId = DB::table('departments')->where('name', 'Recursos Humanos')->value('id');

        DB::table('departments')->updateOrInsert(
            ['name' => 'Operações'],
            ['created_at' => now(), 'updated_at' => now()]
        );
        $collaboratorDepartmentId = DB::table('departments')->where('name', 'Operações')->value('id');

        $profiles = [
            [
                'email' => 'admin@rhcore.local',
                'name' => 'Administrador',
                'role' => 'admin',
                'permissions' => '["admin"]',
                'department_id' => $adminDepartmentId,
                'address' => 'Rua do Administrador, 123',
                'zip_code' => '1234-123',
                'city' => 'Lisboa',
                'phone' => '900000001',
                'salary' => 8000,
                'admission_date' => '2020-01-01',
            ],
            [
                'email' => 'rh@rhcore.local',
                'name' => 'Responsável de RH',
                'role' => 'rh',
                'permissions' => '["rh"]',
                'department_id' => $rhDepartmentId,
                'address' => 'Rua dos Recursos Humanos, 456',
                'zip_code' => '1234-456',
                'city' => 'Lisboa',
                'phone' => '900000002',
                'salary' => 3500,
                'admission_date' => '2022-03-15',
            ],
            [
                'email' => 'colaborador@rhcore.local',
                'name' => 'Colaborador',
                'role' => 'colaborator',
                'permissions' => '["colaborator"]',
                'department_id' => $collaboratorDepartmentId,
                'address' => 'Rua dos Colaboradores, 789',
                'zip_code' => '1234-789',
                'city' => 'Lisboa',
                'phone' => '900000003',
                'salary' => 2200,
                'admission_date' => '2024-05-20',
            ],
        ];

        foreach ($profiles as $profile) {
            DB::table('users')->updateOrInsert(
            ['email' => $profile['email']],
            [
                'department_id' => $profile['department_id'],
                'name' => $profile['name'],
                'email_verified_at' => now(),
                'password' => bcrypt('Aa123456'),
                'role' => $profile['role'],
                'permissions' => $profile['permissions'],
                'created_at' => now(),
                'updated_at' => now(),
            ]
            );

            $userId = DB::table('users')->where('email', $profile['email'])->value('id');

            DB::table('user_details')->updateOrInsert(
                ['user_id' => $userId],
                [
                    'address' => $profile['address'],
                    'zip_code' => $profile['zip_code'],
                    'city' => $profile['city'],
                    'phone' => $profile['phone'],
                    'salary' => $profile['salary'],
                    'admission_date' => $profile['admission_date'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
