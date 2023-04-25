<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Login extends Authenticatable implements JWTSubject
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $table = 'user';
    protected $primarykey = 'id';
    protected $fillable = [
        "name",
        "email",
        "password",  
        "profile_photo",  
        "is_verified",  
        "remember_token",  
        "email_verified_at",  
        "phone"
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
