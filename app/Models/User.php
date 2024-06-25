<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $table = 'users';

    protected $fillable = [
        'email',
        'password',
        'name',
        'icno',
        'gender',
        'dob',
        'phone_number',
        'address',
        'state',
        'postcode',
        'about',
        'image',
        'role_id',
        'blacklist',
        'blacklist_end_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

        /**
     * Scope a query to only include admins.
     */
    public function scopeAdmins($query)
    {
        return $query->where('role_id', 1);
    }

    /**
     * Scope a query to only include moderators.
     */
    public function scopeModerators($query)
    {
        return $query->where('role_id', 2);
    }

    /**
     * Scope a query to only include volunteers.
     */
    public function scopeVolunteers($query)
    {
        return $query->where('role_id', 3);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function assignedEvents()
    {
        return $this->belongsToMany(Event::class, 'events_assigned', 'user_id', 'event_id');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'users_skills', 'user_id', 'skill_id');
    }

    public function isBlacklisted()
    {
        return $this->blacklist && ($this->blacklist_end_date === null || $this->blacklist_end_date > now());
    }
}
