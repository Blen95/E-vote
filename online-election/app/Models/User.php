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

    /*protected $hidden = [
        'password', 'remember_token',
    ];
*/
    protected $dates = ['deleted_at'];

    

    

public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user is a shareholder.
     *
     * @return bool
     */
    public function isShareholder()
    {
        return $this->role === 'shareholder';
    }

    /**
     * Check if the user is a candidate.
     *
     * @return bool
     */
    public function isCandidate()
    {
        return $this->role === 'candidate';
    }

    /**
     * Check if the user is a member of the board of directors (bod).
     *
     * @return bool
     */
    public function isBoardMember()
    {
        return $this->role === 'bod';
    }

    /**
     * Check if the user is an employee.
     *
     * @return bool
     */
    public function isEmployee()
    {
        return $this->role === 'employee';
    }

    // You can define additional role checking methods as needed...
}