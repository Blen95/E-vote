<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'fname' => 'John',
            'lname' => 'Doe',
            'email' => 'john.doe@example.com',
            'username' => 'johndoe',
            'password' => Hash::make('password'), // Use Hash::make() to hash the password
            'role' => 'admin',
        ]);
    }
}
