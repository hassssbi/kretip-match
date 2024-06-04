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

    // Relationship to the User who submitted the application
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relationship to the Event the application is for
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    // Relationship to the Moderator who handled the application
    public function moderator()
    {
        return $this->belongsTo(User::class, 'mod_id', 'id');
    }
}
