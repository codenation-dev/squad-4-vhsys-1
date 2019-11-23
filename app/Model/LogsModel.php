<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LogsModel extends Model
{
    //
    protected $table = 'logs';
    protected $fillable = ['eventos','id_user_alteracao','id_user_cad','level','log'];
    
}
