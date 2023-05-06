<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notification';
    protected $primarykey = 'id';
    protected $fillable = [
        "notification_text",
        "is_view",
        "user_id",   
        "published_at",   
        "type",      
    ];
}
