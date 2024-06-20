<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    
    protected $table = 'candidate'; // Table name in your database

    protected $primaryKey = 'candidate_id'; // Primary key column name

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'election_id',
        'status',
        'manifesto' 
    ];
        

    /**
     * Get the election that the candidate is participating in.
     */
    public function election()
    {
        return $this->belongsTo(Election::class, 'election_id', 'eid');
    }
}
