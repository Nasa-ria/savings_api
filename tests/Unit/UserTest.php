<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;
use Tests\CreatesApplication;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Password;
use Laravel\Passport\Bridge\UserRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Database\Eloquent\Factories\HasFactory;




class UserTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
        use WithFaker;
        use CreatesApplication;
        use HasFactory;  
    /**
     * A basic unit test example.
     *
     * @return void
     */


     public function setUp() : void
     {
        parent::setUp();
        $this->artisan('passport:install');
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
        
        // $response ->assertStatus(200)->json(true);
        $response->assertStatus(200);
    }
     

     /** @test */
     public function test_database2(){
        $this->assertDatabaseMissing('users',[
            'full_name'=>'uyt Doe'
        ]);
     }
     #test if seeders works
    //  public function test_if_seeder_works(){
    //     // seeds all seeders in te seeders folder.
    //     $this->seed();  // equals to php artisan db:seed
 
    //  }

           /** @test */
        public function test_update_user(){
            $this->withoutExceptionHandling();

            $user = User::factory()->create();
                // $this->login();
            $data = [
                'address' => $this->faker->address,
                'contact' => $this->faker->contact,
                'subscription' => $this->faker->subscription,
                'next_of_king_fullname' => $this->faker->next_of_king_fullname,
                'next_of_king_contact' => $this->faker->next_of_king_contact,
                'next_of_king_address' => $this->faker->next_of_king_addressl,
            ];

             $userRepo = new UserRepository($data);
            $update = $userRepo->update($data);
            
            $this->assertTrue($update);
            $this->assertEquals($data['contact'], $user->contact);
            $this->assertEquals($data['address'], $user->address);
            $this->assertEquals($data['subscription'], $user->subscription);
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
            public function the_user_can_update_their_password()
            {
                $this->withoutExceptionHandling();

                User::factory()->create([
                    'email' => 'user@domain.com',
                    'password' => Hash::make('oldpassword')
                ]);

                $token = Password::createToken(User::first());

                Event::fake();

                $response = $this->post('api/changePassword', [
                    'old_password' => 'oldpassword',
                    'new_password' => 'newpassword',
                    'confirm_password' => 'newpassword',
                    'token' => $token
                ]);

                dump(User::first()->password);

                $response->assertStatus(200);

                $this->assertTrue(Hash::check('newpassword', User::first()->password));
                
                Event::assertDispatched(PasswordReset::class);
            }
        }
