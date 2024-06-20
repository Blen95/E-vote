<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'fname' => 'Admin',
            'lname' => 'User',
            'email' => 'admin@example.com',
            'username' => 'adminuser',
            'password' => Hash::make('password'), // Ensure the password is hashed
            'role' => 'admin',
        ]);

        // Create shareholder user
        User::create([
            'fname' => 'Shareholder',
            'lname' => 'User',
            'email' => 'shareholder@example.com',
            'username' => 'shareholderuser',
            'password' => Hash::make('password'), // Ensure the password is hashed
            'role' => 'shareholder',
        ]);

        // Create candidate user
        User::create([
            'fname' => 'Candidate',
            'lname' => 'User',
            'email' => 'candidate@example.com',
            'username' => 'candidateuser',
            'password' => Hash::make('password'), // Ensure the password is hashed
            'role' => 'candidate',
        ]);

        // Create employee user
        User::create([
            'fname' => 'Employee',
            'lname' => 'User',
            'email' => 'employee@example.com',
            'username' => 'employeeuser',
            'password' => Hash::make('password'), // Ensure the password is hashed
            'role' => 'employee',
        ]);
    }
}
