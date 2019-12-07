<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogTest extends TestCase
{
   protected $token;

    protected function setUp() : void
    {
        parent::setUp();

        $userRandom = \App\User::all()->random();
        //$userRandom = factory(\App\User::class)->create();

        $user = [
            'email' => $userRandom->email,
            'password' => '1234567'
        ];

        $token = $this->post(route('requestToken'), $user)->getContent();
        $this->token = json_decode($token)->token;
    }

    public function testListLogs()
    {
        $response = $this
            ->withHeaders(['Authorization' => 'bearer'.$this->token])
            ->get(route('logs'));

        $response->assertStatus(200);
    }

    public function testSingleLog()
    {
        $log = \App\Log::all()->random();

        $response = $this
            ->withHeaders(['Authorization' => 'bearer'.$this->token])
            ->get(route('single_logs', ['id' => $log->id]));
        $response->assertStatus(200);

    }

    public function testCreateLog()
    {
        $log = factory(\App\Log::class)->make();

        $data = [
            'ambience'      => $log->ambience,
            'level'         => $log->level,
            'log'           => $log->log,
            'events'        => $log->events,
            'status'        => $log->status,
            'title'         => $log->title
        ];

        $response = $this
            ->withHeaders(['Authorization' => 'bearer'.$this->token])
            ->post(route('create_logs'), $data);
        $response->assertStatus(201);
    }

    public function testDeleteLog()
    {
        $log = \App\Log::all()->random();

        $response = $this
            ->withHeaders(['Authorization' => 'bearer'.$this->token])
            ->delete(route('delete', ['id' => $log->id]));
        $response->assertStatus(503);
    }

    public function testToFileLog(){
        $log = \App\Log::all()->random();

        $response = $this
            ->withHeaders(['Authorization' => 'bearer'.$this->token])
            ->delete(route('tofile', ['id' => $log->id]));
        $response->assertStatus(503);
    }
}
