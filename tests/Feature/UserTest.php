<?php

namespace Tests\Feature;

use Tests\TestCase;


class UserTest extends TestCase
{
    public function testRequestTokenUser() {
        $user = [
            'email' => 'joaao@joao.com',
            'password' => '12345'
        ];

        $response = $this->post(route('requestToken'), $user);
        $response->assertStatus(200);
    }


}
