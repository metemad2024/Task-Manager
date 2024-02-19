<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_for_add_hotel_review()
    {
        $user = User::create([
            'name' => rand(),
            'email' => rand() . '.abc@xyz.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //$user = User::create($userData);
        $hotel = Hotel::create([
            'name' => rand(),
            'star' => 2,
            'address' => 'Opposite Town Hall, Nr. Sakar II & IV, Ashram Rd, Ellisbridge, Ahmedabad, Gujarat 380006',
            'active' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
 
        $payload = [
            "hotel_id" => $hotel->id,
            "user_id" => $user->id,
            "review_title" => "test",
            "review_data" => "test description"
        ];
 
        $this->json('POST', 'api/save-hotel-review', $payload)
            ->assertStatus(200)
            ->assertJson([
                'code' => '200',
                'message' => 'Hotel Review saved.',
            ]);
    }
}
