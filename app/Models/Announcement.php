<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    public $table = 'announcements';

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'event_id',
    ];

    // Define the relationship with the Event model
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
