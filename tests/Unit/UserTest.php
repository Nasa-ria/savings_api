<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
  
    public function test_login()
    {
        // $this->withoutMiddleware();

        $response = $this->post('api/SignIn',[
            'full_name' => 'user one',
            'email' => 'user1@gmail.com',
            'password' =>'userone1',
            'password_confirmation'=>'userone1'
        ]);
        // $response ->assertStatus(200)->json(true);
        $response->assertStatus(200);
    }

    
}
