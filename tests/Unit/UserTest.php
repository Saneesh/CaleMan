<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UserTest extends TestCase {
  use RefreshDatabase;
  use WithoutMiddleware;

  /** @ test */
  public function user_can_login_with_correct_credentials() {
    $this->withoutExceptionHandling();

    $user = factory(User::class)->create();
    
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertRedirect('/home');

    $this->assertEquals(200, $response->getStatusCode());
    
    $this->assertAuthenticatedAs($user);
  }

  /** @test */
  public function user_cannot_login_with_incorrect_password() {
    // Create user in database
    $user = factory(User::class)->create();
    
    // User is 'from' '/login' page.
    $response = $this->from('/login')->post('/login', [
        'email' => $user->email,
        'password' => 'invalid-password',
    ]);
    
    $response->assertRedirect('/login');
    $response->assertSessionHasErrors('email');
    $this->assertTrue(session()->hasOldInput('email'));
    $this->assertFalse(session()->hasOldInput('password'));
    $this->assertGuest();
  }  

  /**
   * @test
   */
  public function a_user_can_be_registered_and_login() {
    // Creates user object.
    $user = factory(User::class)->make();

    $response = $this->post('register', [
        'name' => $user->name,
        'email' => $user->email,
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertRedirect(route('home'));
  }
}
