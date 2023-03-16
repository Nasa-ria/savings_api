<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
// use App\Mail\Mail;
use App\Mail\Test;
use Tests\TestCase;
use App\Models\User;
use Tests\CreatesApplication;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;





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


    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('passport:install');
        #creat user seeder
        $this->seed('UsersTableSeeder');
    }



    /** @test */
    public function test_signup()
    {
        $this->withoutExceptionHandling();
        #test for signing up 

        $input = [
            'full_name' => 'user one',
            'email' => 'user90@gmail.com',
            'password' => 'userone1',
            'password_confirmation' => 'userone1'
        ];
        // $response = $this->postJson('/api/users', $input);
        $mail= 
        $response = $this->json('POST', route('users.store'), $input);
        $mail= $response->email;
        Mail::assertSent(function ($mail) {
            // Make any assertions you need to in here.
            return 'sent';
        });
        // dd($response);
        $response->assertStatus(200)->json(true);
    }


    /** @test */
    public function test_database2()
    {
        $this->assertDatabaseMissing('users', [
            'full_name' => 'uyt Doe'
        ]);
    }



    /** @test */
    public function  test_a_visitor_can_able_to_login()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);
        $input = [
            'email' => $user->email,
            'password' => $password,
        ];
        $response = $this->json('POST', route('signin', $input));
        // dd($response);
        // $response = $this->actingAs($user);
        $response->assertStatus(200);
    }



    /** @test */
    public function test_to_fetch_all_user()
    {
        $this->withoutExceptionHandling();
        // $response = $this->get('api/users');
        $response = $this->json('GET', route('allUsers'));
        // dd($response);
        $response->assertStatus(200);
    }


    /** @test */
    public function test_delete_user()
    {
        $this->withoutExceptionHandling();
        // First The user is created
        $user = User::factory()->create();
        $response = $this->json('DELETE', route('users.destroy', $user));
        $this->assertEquals(200, $response->getStatusCode());
    }


    /** @test */
    public function test_user_profile()
    {
        $this->withoutExceptionHandling();
        // First The user is created
        $user = User::factory()->create();
        // Then we want to make sure a profile page is created
        $response = $this->json('GET', route('profile', $user));
        $response->assertStatus(200);
    }


    /** @test */
    public function test_for_email_sending()
    {
        $this->withoutExceptionHandling();
        Mail::fake();

        $this->withToken('invalidToken', 'Basic')
            ->get('your.route.name');
    
        Mail::assertSent(function ($mail) {
            // Make any assertions you need to in here.
            return $mail->hasTo('foo@example.com');
        });
    }




    //    /** @test */
    public function test_update_user()
    {
        $this->withExceptionHandling();

        //creating a user
        $user = User::factory()->create();


        //passing updating values

        $input = [
            'subscription' => 'weekly',
            'contact' => 9842345562,
            'address' => 'lapaz.Accra,Ghana.',
            'next_of_kin_fullname' => 'Ama kojo',
            'next_of_kin_address' => 'lapaz.Accra,Ghana.',
            'next_of_kin_contact' => '678934567'

        ];
        // $response = $this->patchJson('/api/users/' . $user->id, $input);
        $response = $this->json('PATCH', route('users.update', $user), $input);
        $response->assertStatus(200)->json(true);
        // $this->assertEquals($user);
    }



    /** @test */
    public function test_the_user_can_update_their_password()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'password' => Hash::make('USER_ORIGINAL_PASSWORD'),
        ]);
        $token = Password::createToken(User::first());
        $password = Str::random();
        $input = [
            'token' => $token,
            'old_password' => 'USER_ORIGINAL_PASSWORD',
            'new_password' => $password,
            'confirm_password' => $password,
        ];
        $response = $this->json('POST', route('passwordchange', $input));
        $this->assertTrue(Hash::check($response->new_assword, $user->password));
    }

    public function test_index()
    {
        $response = $this->json('GET', route('users.index'));
        dd($response);
    }
}
