<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;
    protected $table='election';
    protected $primaryKey = 'eid';

    protected $fillable = [
        'election_name',
        'description',
        'start_date',
        'end_date',
        'eligible_voters',
    ];
    protected $casts = [
        'eligible_voters' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function candidate()
    {
        return $this->hasMany(Candidate::class, 'election_id', 'eid');
    }

    

    public function votes()
    {
        return $this->hasMany(Vote::class, 'election_id', 'eid');
    }
}
