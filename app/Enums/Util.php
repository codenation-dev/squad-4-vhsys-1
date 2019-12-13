<?php


namespace App\Enums;


use App\Log;
use App\Services\Contracts\LogServiceInterface;
use App\Services\LogService;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class Util
{
    public function send_curl($data){
        $log = new Log();
        $log->level = $data['level'];
        $log->log = $data['log'];
        $log->events = $data['events'];
        $log->ambience = $data['ambience'];
        $log->status = $data['status'];
        $log->title = $data['title'];
        $log->user_created = empty(Auth::id())?'12':Auth::id();
        $log->save();

    }
}
