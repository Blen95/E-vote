<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Election;
use App\Models\Vote;
use Illuminate\Validation\ValidationException;

class ElectionController extends Controller
{
    public function create(Request $request)
    {
        try {
            // Validate the input data
            $validatedData = $request->validate([
                'election_name' => 'required|string|max:20',
                'description' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'eligible_voters' => 'required|array', // Ensure eligible_voters is an array
                'eligible_voters.*' => 'string', 
            ]);

            // Create a new instance of the Election model with validated data
            $election = new Election();
            $election->election_name = $validatedData['election_name'];
            $election->description = $validatedData['description'];
            $election->start_date = $validatedData['start_date'];
            $election->end_date = $validatedData['end_date'];
            $election->eligible_voters = json_encode($validatedData['eligible_voters']);

            // Save the record to the database
            $election->save();

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Election created successfully!');
        } catch (ValidationException $e) {
            // Redirect back with validation errors if validation fails
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            // Handle other exceptions (e.g., database errors)
            return redirect()->back()->with('error', 'An error occurred while creating the election.');
        }
    }

    public function close($id)
    {
        $election = Election::findOrFail($id);

        if ($election->status === 'closed') {
            return redirect()->back()->with('error', 'Election is already closed.');
        }

        $election->status = 'closed';
        $election->save();

        return redirect()->back()->with('success', 'Election closed successfully.');
    }
    public function open($id)
    {
        $election = Election::findOrFail($id);

        if ($election->status === 'open') {
            return redirect()->back()->with('error', 'Election is already open.');
        }

        $election->status = 'open';
        $election->save();

        return redirect()->back()->with('success', 'Election opened successfully.');
    }
    public function approveCandidate($eid,$candidateid){
        Vote::create([
            'election_id' => $eid,
            'candidate_id' => $candidateid,
        ]);
    }
}
