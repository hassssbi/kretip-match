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

    // Relationship to the User who provided the feedback
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relationship to the Event the feedback is for
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
