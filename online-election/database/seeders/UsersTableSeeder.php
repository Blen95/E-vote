<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::factory()->create([
            'fname' => 'Admin',
            'lname' => 'User',
            'email' => 'admin@example.com',
            'username' => 'adminuser',
            'role' => 'admin',
        ]);

        // Create shareholder user
        User::factory()->create([
            'fname' => 'Shareholder',
            'lname' => 'User',
            'email' => 'shareholder@example.com',
            'username' => 'shareholderuser',
            'role' => 'shareholder',
        ]);

        // Create candidate user
        User::factory()->create([
            'fname' => 'Candidate',
            'lname' => 'User',
            'email' => 'candidate@example.com',
            'username' => 'candidateuser',
            'role' => 'candidate',
        ]);

        // Create employee user
        User::factory()->create([
            'fname' => 'Employee',
            'lname' => 'User',
            'email' => 'employee@example.com',
            'username' => 'employeeuser',
            'role' => 'employee',
        ]);
    }
}