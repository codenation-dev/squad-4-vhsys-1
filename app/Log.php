<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Log extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'ambience',
        'level',
        'log',
        'events',
        'status',
        'title',
        'user_created',
    ];

    /**
     * Opcional, informar a coluna deleted_at como um Mutator de data
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function search($query){
        return DB::select($query);
    }


}
