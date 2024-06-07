<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends User
{
    use HasFactory;

    public $table = 'users';

    protected $attributes = [
        'role_id' => 1,
    ];
}
