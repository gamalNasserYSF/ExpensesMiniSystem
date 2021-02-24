<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
//    use RefreshDatabase;


    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test User1',
            'email' => 'test@example.com2',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role_id' => 2,
            'isManager' => 0
        ]);

        $response->assertRedirect('/expense');
    }

}
