<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_to_fetch_all_users()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('api/users');
        $response->assertStatus(200);
        $this->assertTrue(true);
    }


    public function test_to_fetch_all_user_transactions(){
        
    }
}
