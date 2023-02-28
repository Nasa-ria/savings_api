<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
// use App\Mail\Mail;
use App\Mail\Test;
use Tests\TestCase;
use App\Models\User;
use App\Mail\UserInvite;
use Tests\CreatesApplication;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Password;
use Laravel\Passport\Bridge\UserRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Database\Eloquent\Factories\HasFactory;





class UserTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
        use WithFaker;
        use CreatesApplication;
        use HasFactory;  
        use WithoutMiddleware;
    /**
     * A basic unit test example.
     *
     * @return void
     */


     public function setUp() : void
     {
        parent::setUp();
        $this->artisan('passport:install');
       #creat user seeder
        $this->seed('UsersTableSeeder');
     }


  
     /** @test */
    public function test_login()
    {
        $this->withoutExceptionHandling();
        #test for signing up 
         User::factory()->create()->createToken('test');
        $response = $this->post('api/user',[
            'full_name' => 'user one',
            'email' => 'user6723@gmail.com',
            'password' =>'userone1',
            'password_confirmation'=>'userone1'
        ]);   
        //    Mail::to('ben@google.com')->send(new test());
           Mail::raw('Hello World!', function($msg) {$msg->to('myemail@gmail.com')->subject('Test Email'); });
        // $response ->assertStatus(200)->json(true);
        $response->assertStatus(200);
    }
     

     /** @test */
     public function test_database2(){
        $this->assertDatabaseMissing('users',[
            'full_name'=>'uyt Doe'
        ]);
     }



    /** @test */
    public function a_visitor_can_able_to_login()
    {
        $user = User::factory()->create();

        $hasUser = $user ? true : false;

        $this->assertTrue($hasUser);

        $response = $this->actingAs($user);
    }



     /** @test */
     public function test_to_fetch_all_user(){
        $this->withoutExceptionHandling();
        $response = $this->get('api/users');
        $response->assertStatus(200);
     }


     /** @test */
     public function test_delete_user(){
        $this->withoutExceptionHandling();
         // First The user is created
         $user = User::factory()->create();
         //act as user
         $this->actingAs($user);
        $response = $this->delete('api/user/'.$user->id);
        $this->assertEquals(200, $response->getStatusCode());


     }


     /** @test */
     public function test_user_profile(){
     $this->withoutExceptionHandling();
     // First The user is created
      $user = User::factory()->create();
         //act as user
     $this->actingAs($user);
         // Then we want to make sure a profile page is created
     $response = $this->get('/api/profile/'.$user->id);
         //
     $response->assertStatus(200);
    }


         /** @test */
     public function test_for_email_sending()
    {
        $this->withoutExceptionHandling();
        Mail::fake();
        $data = [
                        'title' => 'Mail from ItSolutionStuff.com',
                        'body' => 'This is for testing email using smtp.'
                    ];
        $mail= Mail::to('emailTesting@gmail.com')->send(new Test($data));

        Mail::assertSent(Test::class);
    }




        //    /** @test */
        public function test_update_user(){
            $this->withExceptionHandling(); 

            //creating a user
            $user = User::factory()->create();
        
            //signing in as the new user
            $this->actingAs($user);
        
            //passing updating values
            $response = $this->put('api/update'.$user->id, [
                // 's' => 'name123',
                // 'contact' => 9842345562,
                'address' => 'Accra,Ghana.lapaz'
            ]);
        
            //Get new values
            $user->refresh();
            // $this->assertEquals(9842345562, $user->contact);
            $this->assertEquals('Accra,Ghana.lapaz', $user->address);
        }

         

                    /** @test */
            // public function the_user_can_update_their_password()
            // {
            //     $this->withoutExceptionHandling();

            //     User::factory()->create([
            //         'email' => 'user@domain.com',
            //         'password' => Hash::make('oldpassword')
            //     ]);

            //     $token = Password::createToken(User::first());

            //     Event::fake();

            //     $response = $this->post('api/changePassword', [
            //         'old_password' => 'oldpassword',
            //         'new_password' => 'newpassword',
            //         'confirm_password' => 'newpassword',
            //         // 'token' => $token
            //     ]);

            //     dump(User::first()->password);

            //     $response->assertStatus(200);

            //     $this->assertTrue(Hash::check('newpassword', User::first()->password));
                
            //     Event::assertDispatched(PasswordReset::class);
            // }

            

            



            


               



        }
