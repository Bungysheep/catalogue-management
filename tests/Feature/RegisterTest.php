<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function testRegisterRequiresNameEmailAndPassword()
    {
        $this->json('post', '/api/register')
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => [
                        'The name field is required.'
                    ],
                    'email' => [
                        'The email field is required.'
                    ],
                    'password' => [
                        'The password field is required.'
                    ],
                ]
            ]);
    }

    public function testRegisterRequiresValidEmail()
    {
        $payload = [
            'name' => 'James Embongbulan',
            'email' => 'james.embongbulan',
            'password' => 'asdf1234',
            'password_confirmation' => 'asdf1234'
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'email' => [
                        'The email must be a valid email address.'
                    ],
                ]
            ]);
    }

    public function testRegisterRequiresPasswordConfirmation()
    {
        $payload = [
            'name' => 'James Embongbulan',
            'email' => 'james.embongbulan@gmail.com',
            'password' => 'asdf1234',
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'password' => [
                        'The password confirmation does not match.'
                    ],
                ]
            ]);
    }

    public function testRegisterSuccessfully()
    {
        $payload = [
            'name' => 'James Embongbulan',
            'email' => 'james.embongbulan@gmail.com',
            'password' => 'asdf1234',
            'password_confirmation' => 'asdf1234'
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }
}
