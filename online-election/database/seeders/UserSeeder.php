
<?php
use Illuminate\Database\Seeder;
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
