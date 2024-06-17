<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    protected $table = 'votes'; // Table name

    protected $fillable = [
        'election_id',
        'candidate_id',
        'vote_count'
    ];

    /**
     * Get the election associated with the vote.
     */
    public function election()
    {
        return $this->belongsTo(Election::class, 'election_id', 'eid');
    }

    /**
     * Get the candidate associated with the vote.
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id', 'candidate_id');
    }
}
