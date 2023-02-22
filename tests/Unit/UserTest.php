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
        #test for signing up 
        $response = $this->post('api/user',[
            'full_name' => 'user one',
            'email' => 'user0@gmail.com',
            'password' =>'userone1',
            'password_confirmation'=>'userone1'
        ]);
        // $response ->assertStatus(200)->json(true);
        $response->assertStatus(200);
    }

    #test for checking if user exist
     public function test_database(){
        $this->assertDatabaseHas('users',[
            'full_name'=>'Jane Doe'
        ]);
     }

     public function test_database2(){
        $this->assertDatabaseMissing('users',[
            'full_name'=>'John Doe'
        ]);
     }
}
