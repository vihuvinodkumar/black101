<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;
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
        "is_donated",  
    ];
}
