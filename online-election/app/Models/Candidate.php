<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $table = 'candidate'; // Correct table name in your database

    protected $primaryKey = 'id'; // Primary key column name (default 'id' in Laravel)

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'election_id',
        // 'cv_path',
        'status',
        'manifesto',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (is_null($model->status)) {
                $model->status = 'pending'; // Set default value for status
            }
        });
    }

    /**
     * Get the election that the candidate is participating in.
     */
    public function election()
    {
        return $this->belongsTo(Election::class, 'election_id', 'eid');
    }
}
