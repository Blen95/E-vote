<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Election;

class CandidateController extends Controller
{
    public function showRegistrationForm()
    {
        $elections= Election::all(); // Fetch all elections to populate the select dropdown
        return view('online-election.resources.views.ui.production.candidateregister', compact('elections'));
    }

    public function register(Request $request)
    {
        // Validate form data
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:candidate,email',
            'election_id' => 'required|exists:election,eid',
            // 'cv' => 'required|mimes:pdf,doc,docx|max:2048',
            // 'status' => 'required|in:pending,accepted,denied',
            'manifesto' => 'required',
        ]);

        // try {
        //     // Handle file upload (CV)
        //     if ($request->hasFile('cv')) {
        //         $cvFileName = time() . '_' . $request->file('cv')->getClientOriginalName();
        //         $cvPath = $request->file('cv')->storeAs('cv_uploads', $cvFileName);
        //     }

            // Create new candidate record
            Candidate::create([
                'fname' => $request->input('fname'),
                'lname' => $request->input('lname'),
                'email' => $request->input('email'),
                'election_id' => $request->input('election_id'),
                'status' => $request->input('status', 'pending'), // Set default value for status
                'manifesto' => $request->input('manifesto'),
                // 'cv_path' => $cvPath ?? null,
            ]);

            // Return a success response or redirect
            return redirect()->back()->with('success', 'Candidate registered successfully!');
        // } catch (\Exception $e) {
        //     // Log the exception or handle it as per your application's error handling strategy
        //     // Log::error('Candidate registration error: ' . $e->getMessage());

        //     // Return an error response or redirect back with errors
        //     return redirect()->back()->with('error', 'Failed to register candidate. Please try again.');
        // }
    }
}
