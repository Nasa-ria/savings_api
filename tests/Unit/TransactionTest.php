<?php

namespace Tests\Unit;
use Tests\TestCase;
use App\Models\User;
use App\Models\Deposit;
use Tests\CreatesApplication;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    use WithFaker;
    use CreatesApplication;
    use HasFactory;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_deposit()
    {
        $this->withoutExceptionHandling();
           $user = User::factory()->create();
           $this->actingAs($user);
        $input = [
        
            'amount_deposited' => 60  ,
             
               
        ];
        $response = $this->json('POST', route('deposit', $input));
        
        // $this->assertEquals(200, $response->getStatusCode());
        $response->assertStatus(200);
    }
}
