<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'rating';
    protected $primarykey = 'id';
    protected $fillable = [
        "product_id",
        "user_id",
        "rating",   
    ];
}
