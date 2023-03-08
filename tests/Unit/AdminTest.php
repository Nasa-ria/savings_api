<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;
// use App\Models\Deposit;
use App\Models\Deposit;
use App\Models\Withdrawal;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;
    use HasFactory; 
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
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        
        //signing in as the new user
        $this->actingAs($user);
        if($user->id){
            $deposits = Deposit::where('user_id' ,'=' ,$user)->get(); 
            $withdrawals = Withdrawal::where('user_id' ,'=' ,$user);
        }
    
        $response = $this->get('api/tansactions/'.$user->id);
        $response->assertStatus(200);
        $this->assertTrue(true);
    }

     /** @test */
     public function test_profile(){
       
        // First The user is created
         $user = User::factory()->create();
         $deposits = Deposit::factory()->create();
    
         $withdrawals =  Withdrawal::factory()->create();
            //act as user
        $this->actingAs($user);
        if($user->id){
            $deposits = Deposit::where('user_id' ,'=' ,$user)->get(); 
            $withdrawals = Withdrawal::where('user_id' ,'=' ,$user);
        }
    
            // Then we want to make sure a profile page is created
        $response = $this->get('/api/profile/'.$user->id);
            //
        $response->assertStatus(200);
       }
        /** @test */
       public function test_search(){
        $this->withoutExceptionHandling();
        $user = User::factory()->create([
            'full_name' => 'john Doe',
        ]);
        // $response = $this->get('api/search');
        $input = ['search'=>'john Doe'];
        $response = $this->json('GET',route('search',$input));
        
        // $Search = User::search($user->full_name)->where('full_name', $user->full_name)->get();
        $this->assertEquals($user->full_name, $response[0]['full_name']); 
       }
}
