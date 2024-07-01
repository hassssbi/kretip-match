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
        'latitude',
        'longitude',
        'status',
        'poster',
        'num_of_needed_vol',
        'user_id',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'events_skills');
    }

    public function assignedUsers()
    {
        return $this->belongsToMany(User::class, 'events_assigned', 'event_id', 'user_id');
    }

    public function moderator()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function isFull()
    {
        return $this->assignedUsers()->count() >= $this->num_of_needed_vol;
    }

    public function isCompleted()
    {
        return $this->status === 'Completed';
    }
}
