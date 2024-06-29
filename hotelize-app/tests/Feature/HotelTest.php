<?php

namespace Tests\Feature;

use App\Models\Hotel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HotelTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_hotel()
    {
        $response = $this->postJson('/hotels', [
            'name' => 'Hotel Test',
            'address' => '123 Main St',
            'city' => 'Springfield',
            'state' => 'IL',
            'zip_code' => '62701-123',
            'website' => 'https://hotel.test',
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'name' => 'Hotel Test',
            'address' => '123 Main St',
            'city' => 'Springfield',
            'state' => 'IL',
            'zip_code' => '62701-123',
            'website' => 'https://hotel.test',
        ]);
    }

    public function test_create_room()
    {
        $hotel = Hotel::factory()->create();

        $response = $this->postJson('/api/rooms', [
            'hotel_id' => $hotel->id,
            'name' => 'Room Test',
            'description' => 'This is a test room.',
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'hotel_id' => $hotel->id,
            'name' => 'Room Test',
            'description' => 'This is a test room.',
        ]);
    }
}
