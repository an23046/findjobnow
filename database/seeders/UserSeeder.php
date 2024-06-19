<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $employeeRole = Role::create(['name' => 'Employee']);
        $employerRole = Role::create(['name' => 'Employer']);

        $user = User::factory()->create([
            'name' => 'Nastya',
            'email' => 'Nastja.Nik.07.05@gmail.com',
            'password' => 'Nastja755'
        ]);

        $user2 = User::factory()->create([
            'name' => 'Nastya2',
            'email' => 'an19062@edu.lu.lv',
            'password' => 'Nastja755'
        ]);

        $user->assignRole($employeeRole);
        $user2->assignRole($employerRole);

    }
}
