<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'ambience',
        'level',
        'log',
        'events',
        'status',
        'user_created',
    ];
}
