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
        'name'
    ];

    /**
     * Opcional, informar a coluna deleted_at como um Mutator de data
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_created','id');
    }


    public function search($query){
        return DB::select($query);
    }


}
