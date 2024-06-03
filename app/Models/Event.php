<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $table = 'events';

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'location',
        'status',
        'poster',
        'num_of_needed_vol',
        'user_id',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
