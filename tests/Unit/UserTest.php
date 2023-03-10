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
    public function test_login()
    {
        $this->withoutExceptionHandling();
        #test for signing up 
        $user = User::factory()->create();

        $input = [
            'full_name' => 'user one',
            'email' => 'user90@gmail.com',
            'password' => 'userone1',
            'password_confirmation' => 'userone1'
        ];
        $response = $this->postJson('/api/user', $input);
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
    public function a_visitor_can_able_to_login()
    {
        $user = User::factory()->create();

        // $hasUser = $user ? true : false;

        // $this->assertTrue($hasUser);
        $password = Str::random();
        $input = [
            'email' => 'mtyumariihfgja@gmail.com',
            'password'=>$password  
        ];
        $response = $this->json('POST', route('signin', $input));
        // $response = $this->actingAs($user);
        $response->assertStatus(200);

    }



    /** @test */
    public function test_to_fetch_all_user()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('api/users');
        $response->assertStatus(200);
    }


    /** @test */
    public function test_delete_user()
    {
        $this->withoutExceptionHandling();
        // First The user is created
        $user = User::factory()->create();
        //act as user
        $this->actingAs($user);
        $response = $this->delete('api/user/' . $user->id);
        $this->assertEquals(200, $response->getStatusCode());
    }


    /** @test */
    public function test_user_profile()
    {
        $this->withoutExceptionHandling();
        // First The user is created
        $user = User::factory()->create();
        //act as user
        $this->actingAs($user);
        // Then we want to make sure a profile page is created
        $response = $this->get('/api/profile/' . $user->id);
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
        $mail = Mail::to('emailTesting@gmail.com')->send(new Test($data));

        Mail::assertSent(Test::class);
    }




    //    /** @test */
    public function test_update_user()
    {
        $this->withExceptionHandling();

        //creating a user
        $user = User::factory()->create();

        //signing in as the new user
        $this->actingAs($user);

        //passing updating values

        $input = [
            'subscription' => 'weekly',
            'contact' => 9842345562,
            'address' => 'lapaz.Accra,Ghana.',
            'next_of_kin_fullname' => 'Ama kojo',
            'next_of_kin_address' => 'lapaz.Accra,Ghana.',
            'next_of_kin_contact' => '678934567'

        ];
        $response = $this->patchJson('/api/user/' . $user->id, $input);
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
        $this->assertTrue(Hash::check($response->new_assword,$user->password));
    }
}
