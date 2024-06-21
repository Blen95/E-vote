<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Candidate;
use Illuminate\Support\Facades\Hash; 


class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Candidate::create([
            'fname' => 'John',
            'lname' => 'Doe',
            'email' => 'john.doe@example.com',
            'election_id' => 1,
            
            'manifesto' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
        ]);

    }
}
