<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Election;
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
            ]);

            // Create a new instance of the Election model with validated data
            $election = new Election();
            $election->election_name = $validatedData['election_name'];
            $election->description = $validatedData['description'];
            $election->start_date = $validatedData['start_date'];
            $election->end_date = $validatedData['end_date'];

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
}
