<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }



    public function tickets()
    {
        // return $this->belongsToMany(GenerateTicket::class,'agent_ticket');
        return $this->belongsToMany(GenerateTicket::class, 'agent_ticket', 'agent_id', 'ticket_id');

    }















    // Get the name of the unique identifier for the user.
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    // Get the unique identifier for the user.
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    // Get the password for the user.
    public function getAuthPassword()
    {
        return $this->password;
    }

    // Get the name of the password for the user.
    public function getAuthPasswordName()
    {
        return 'password';
    }

    // Get the token value for the "remember me" session.
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    // Set the token value for the "remember me" session.
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    // Get the column name for the "remember me" token.
    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
