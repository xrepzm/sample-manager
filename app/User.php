<?php

namespace SampleManager;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use SampleManager\Models\Request;

class User extends Authenticatable
{
    use Notifiable;

    // Attributes
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relations
    public function requests()
    {
        return $this->hasMany(Request::class, 'user_id');
    }
}
