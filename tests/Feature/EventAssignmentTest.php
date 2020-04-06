<?php

namespace Tests\Feature;

use App\Models\Entities\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class EventAssignmentTest extends TestCase {
  use RefreshDatabase;

  /**
   * @test
   */
  public function a_user_can_define_their_available_slots_for_a_particular_day() {
    $this->withoutExceptionHandling();

    $user = factory(User::class)->create();

    $response = self::createSlot($user);

    $this->assertDatabaseHas('event_dates', [
      'user_id' => $user->id,      
      'event_date' => Carbon::create('2020-04-05'),
    ]);

    $this->assertDatabaseHas('event_times', [
      'user_id' => $user->id,      
      'slot_start' => '09:00:00',
      'slot_end' => '10:00:00',
      'is_scheduled' => false
    ]);      
    
    $response->assertStatus(200);
    $response->assertJson(['message' => 'Successfully assigned slots!']);
  }

  /**
   * @test
   */
  public function a_user_can_list_their_slots_for_a_particular_day() {
    $this->withoutExceptionHandling();

    $user = factory(User::class)->create();

    $response = self::createSlot($user);

    $response = $this->post('/api/v1/events/list', [
      'user_id' => $user->id,      
      'event_date' => Carbon::create('2020-04-05')
    ]);

    //dd($response->getContent());

    $response->assertStatus(200)
      ->assertJsonStructure([
        'data' => [
          'user_id',
          'event_date', 
          'slots' => [
            '*' => [
              'slot_start',
              'slot_end' 
            ]
          ]
        ]
      ]);
  }

  /**
   * @test
   */
  public function a_user_can_book_an_available_slot() {     

    $response = $this->get('/');
    $response->assertStatus(200);
  }

  /**
   * @ test
   */
  public function an_unauthenticated_user_get_error_message() {     

    
  }

  private function createSlot($user) {   
    Passport::actingAs($user);

    return $this->post('/api/v1/events', [
      'user_id' => $user->id,      
      'event_date' => Carbon::create('2020-04-05'),
      'slots' => [
        [
          'start' => '09:00:00',
          'end' => '10:00:00'
        ],
        [
          'start' => '10:15:00',
          'end' => '11:15:00'
        ],
        [
          'start' => '11:30:00',
          'end' => '12:30:00'
        ],
        [
          'start' => '14:00:00',
          'end' => '15:00:00'
        ]
      ],
      'is_scheduled' => false,
    ]);
  }
}
