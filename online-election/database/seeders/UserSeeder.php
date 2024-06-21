lily, [6/15/2024 6:49 PM]
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert an admin user
        User::create([
            'fname' => 'Admin',
            'lname' => 'User',
            'email' => 'admin@example.com',
            'username' => 'admin',
            'password' => bcrypt('password'), // Replace 'password' with your desired password
            'role' => 'admin',
        ]);

        // Insert a shareholder user
        User::create([
            'fname' => 'Shareholder',
            'lname' => 'User',
            'email' => 'shareholder@example.com',
            'username' => 'shareholder',
            'password' => bcrypt('password'), // Replace 'password' with your desired password
            'role' => 'shareholder',
        ]);
    }
}