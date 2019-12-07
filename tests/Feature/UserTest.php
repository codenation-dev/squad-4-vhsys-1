<?php

namespace Tests\Feature;

use Tests\TestCase;


class UserTest extends TestCase
{
    public function testRequestTokenUser()
    {
        $userRandom = \App\User::all()->random();

        $user = [
            'email' => $userRandom->email,
            'password' => '1234567'
        ];

        $response = $this->post(route('requestToken'), $user);
        $response->assertStatus(200);
    }

    public function testRegisterUser()
    {
        $user = factory(\App\User::class)->make();


    }
}
