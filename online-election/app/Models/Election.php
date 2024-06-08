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
        'election_name', 'start_date', 'end_date'
    ];

    public function nominees()
    {
        return $this->hasMany(Nominee::class, 'election_id', 'eid');
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class, 'election_id', 'eid');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'election_id', 'eid');
    }
}
