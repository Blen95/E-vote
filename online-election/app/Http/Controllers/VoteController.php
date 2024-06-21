<?php

namespace App\Http\Controllers;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vote;

class VoteController extends Controller
{
    public function candidates($eid){
        $user = Auth::user();
               if ($user->role === 'admin'){
            $candidates = Candidate::where('election_id', $eid)->where('status', 'pending')->get();
            session()->put('candidates', $candidates);
            return redirect('/electionopened');
        }
        else{
            $candidates = Candidate::where('election_id', $eid)->where('status', 'approved')->get();
            session()->put('candidates', $candidates);
            return redirect('/electionclosed');
        }
       
           }
           public function vote(Request $request, Candidate $candidate)
           {
               // Increment vote count for the candidate
               $candidate->vote_count += 1;
               $candidate->save();
       
               // Create a new vote record
               Vote::create([
                   'election_id' => $candidate->election_id,
                   'candidate_id' => $candidate->id,
                   'vote_count' => 1, // Initialize vote count as 1 for the first vote
               ]);
       
               return redirect()->back()->with('success', 'Your vote has been counted.');
           
       }
}
