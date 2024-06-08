<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'fname', 'lname', 'email', 'username', 'password', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    public function nominees()
    {
        return $this->hasMany(Nominee::class, 'nominator_id', 'user_id');
    }

    public function candidate()
    {
        return $this->hasOne(Candidate::class, 'user_id', 'user_id');
    }
}
