<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Candidate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the table to remove existing data
        DB::table('candidate')->truncate();

        // Define some sample data
        $candidates = [
            [
                'fname' => 'John',
                'lname' => 'Doe',
                'email' => 'john.doe@example.com',
                'election_id' => 1, // Replace with a valid election_id
                'status' => 'pending',
                'manifesto' => 'My vision is to create a better future for all.',
                'cv_path' => 'cv_uploads/john_doe_cv.pdf',
            ],
            [
                'fname' => 'Jane',
                'lname' => 'Smith',
                'email' => 'jane.smith@example.com',
                'election_id' => 1, // Replace with a valid election_id
                'status' => 'pending',
                'manifesto' => 'Committed to making a difference in our community.',
                'cv_path' => 'cv_uploads/jane_smith_cv.docx',
            ],
            // Add more candidates as needed
        ];

        // Insert the data into the database
        foreach ($candidate as $candidate) {
            Candidate::create($candidate);
        }
    }
}
