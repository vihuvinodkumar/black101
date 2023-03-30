<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donate extends Model
{
    use HasFactory;
    protected $table = 'donate';
    protected $primarykey = 'id';
    protected $fillable = [
        "user_id",
        "donated_at",
        "amount",  
        "transaction_id",  
    ];
}
