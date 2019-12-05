<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogTest extends TestCase
{
    public function testListLogs()
    {
        $response = $this
            ->withHeaders(['Authorization' => 'bearereyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvcmVxdWVzdFRva2VuIiwiaWF0IjoxNTc1NTE0MDA2LCJleHAiOjE1NzU1MTc2MDYsIm5iZiI6MTU3NTUxNDAwNiwianRpIjoiM3k1U1RMVnJ1UXZ5aWx1SSIsInN1YiI6NywicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.kbSXFhQ5iZtuqWurqNuAX9k3SGUph5pWFGLmqM-EfKk'])
            ->get('api/v1/logs/list');
        $response->assertStatus(200);
    }

    public function testSingleLog()
    {
        $response = $this
            ->withHeaders(['Authorization' => 'bearereyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvcmVxdWVzdFRva2VuIiwiaWF0IjoxNTc1NTE0MDA2LCJleHAiOjE1NzU1MTc2MDYsIm5iZiI6MTU3NTUxNDAwNiwianRpIjoiM3k1U1RMVnJ1UXZ5aWx1SSIsInN1YiI6NywicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.kbSXFhQ5iZtuqWurqNuAX9k3SGUph5pWFGLmqM-EfKk'])
            ->get('api/v1/logs/list/4');
        $response->assertStatus(200);

    }

    public function testCreateLog()
    {
        $data = [
            'ambience'      => 'Produção',
            'level'         => 'Error',
            'log'           => 'user.Service.Auth: password.Password.Compare...',
            'events'        => 2,
            'status'        => 'aberto',
            'title'         => 'Error password'
        ];

        $response = $this
            ->withHeaders(['Authorization' => 'bearereyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvcmVxdWVzdFRva2VuIiwiaWF0IjoxNTc1NTE0MDA2LCJleHAiOjE1NzU1MTc2MDYsIm5iZiI6MTU3NTUxNDAwNiwianRpIjoiM3k1U1RMVnJ1UXZ5aWx1SSIsInN1YiI6NywicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.kbSXFhQ5iZtuqWurqNuAX9k3SGUph5pWFGLmqM-EfKk'])
            ->post('api/v1/logs/create', $data);
        $response->assertStatus(201);
    }

    public function testDeleteLog()
    {
        $response = $this
            ->withHeaders(['Authorization' => 'bearereyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvcmVxdWVzdFRva2VuIiwiaWF0IjoxNTc1NTE0MDA2LCJleHAiOjE1NzU1MTc2MDYsIm5iZiI6MTU3NTUxNDAwNiwianRpIjoiM3k1U1RMVnJ1UXZ5aWx1SSIsInN1YiI6NywicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.kbSXFhQ5iZtuqWurqNuAX9k3SGUph5pWFGLmqM-EfKk'])
            ->delete('api/v1/logs/delete/1');
        $response->assertStatus(503);
    }
}
