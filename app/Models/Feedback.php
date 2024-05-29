<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    public $table = 'feedbacks';

    protected $fillable = [
        'event_id',
        'user_id',
        'message',
    ];
}
