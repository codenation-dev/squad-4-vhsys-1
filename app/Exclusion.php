<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exclusion extends Model
{
    protected $table='exclusions';
    protected $fillable = [
        'value',
        'id_user',
    ];
}
