<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Election; // Don't forget to import the Election model

class CandidateController extends Controller
{
    public function showRegistrationForm()
    {
        $elections = Election::all(); // Fetch all elections to populate the select dropdown
        return view('online-election.resources.views.ui.production.candidateregister', compact('elections'));
    }

    public function register(Request $request)
    {
        // Validate form data
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:candidates,email',
            'election_id' => 'required|exists:elections,id', // Ensure election_id exists in elections table
            'status' => 'required',
            'manifesto' => 'required',
            'cv' => 'required|mimes:pdf,doc,docx|max:2048', // Example validation for CV upload
        ]);

        // Handle file upload (CV)
        if ($request->hasFile('cv')) {
            $cvFileName = time() . '_' . $request->file('cv')->getClientOriginalName();
            $cvPath = $request->file('cv')->storeAs('cv_uploads', $cvFileName);
        }

        // Create new candidate record
        $candidate = new Candidate();
        $candidate->fname = $request->input('firstname');
        $candidate->lname = $request->input('lastname');
        $candidate->email = $request->input('email');
        $candidate->election_id = $request->input('election_id');
        $candidate->status = $request->input('status');
        $candidate->manifesto = $request->input('manifesto');
        $candidate->cv_path = $cvPath ?? null; // Save CV path if uploaded
        $candidate->save();

        return redirect()->back()->with('success', 'Candidate registered successfully!');
    }
}
