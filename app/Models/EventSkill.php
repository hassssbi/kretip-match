<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSkill extends Model
{
    use HasFactory;

    protected $table = 'events_skills';

    protected $fillable = [
        'event_id',
        'skill_id'
    ];
}
