<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends User
{
    use HasFactory;

    protected $table = 'users';

    protected $attributes = [
        'role_id' => 3,
    ];

    public function assignedEvents()
    {
        return $this->belongsToMany(Event::class, 'events_assigned', 'user_id', 'event_id');
    }
}
