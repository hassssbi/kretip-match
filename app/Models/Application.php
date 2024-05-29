<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    public $table = 'applications';

    protected $fillable = [
        'status',
        'message',
        'user_id',
        'event_id',
        'mod_id',
    ];
}
