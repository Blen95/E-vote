<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $table = 'candidates'; // Table name

    protected $primaryKey = 'candidate_id'; // Primary key

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'election_id',
        'cv',
        'status'
    ];

    /**
     * Get the election that the candidate is participating in.
     */
    public function election()
    {
        return $this->belongsTo(Election::class, 'election_id', 'eid');
    }
}
