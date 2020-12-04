<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
class AdminControllerTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function login_displays_the_login_form()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function login_displays_validation_errors()
    {
        $response = $this->post('/login', []);

        $response->assertStatus(302);//302 is for redirection
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function login_authenticates_and_redirects_user()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

       $response->assertRedirect('admin');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function register_creates_and_authenticates_a_user()
    {
        $name = $this->faker->name;
        $email = $this->faker->safeEmail;
        $password = $this->faker->password(8);

        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post(route('register'), [
            'name' => $name ,
            'email' => $email ,
            'password' =>  $password ,
            'password_confirmation' =>  $password ,
        ]);
        $user = User::where('email', $email)->where('name', $name)->first();
        $this->assertNotNull($user);

        $response->assertRedirect('admin');
        $this->assertDatabaseHas('users', [
            'name' => $name ,
            'email' => $email
        ]);

        
    }

    /** @test */
    public function can_delete_a_user() 
    {
        //start create user
        $name = $this->faker->name;
        $email = $this->faker->safeEmail;
        $password = $this->faker->password(8);

        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post(route('register'), [
            'name' => $name ,
            'email' => $email ,
            'password' =>  $password ,
            'password_confirmation' =>  $password ,
        ]);
        $user = User::where('email', $email)->where('name', $name)->first();
        $this->assertNotNull($user);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $name ,
            'email' => $email
        ]);
        //fin create user
        $this->withoutMiddleware();
        $response = $this->call('DELETE', '/admin/'.$user->id);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
}
    
}
