<?php

namespace Tests\Feature;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomTest extends TestCase
{
    public function testStore()
    {
        $user = User::factory()->create();
        $hotel = Hotel::factory()->create();
        
        $response = $this->actingAs($user)->post(route('hotels.rooms.store',$hotel->id), [
            'hotel_id' => $hotel->id,
            'name' => 'Quarto 1',
            'description' => 'Descrição do quarto 1',
        ]);

        $response->assertRedirect(route('hotels.show', $hotel->id));
    }

    public function testUpdate()
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();
        $hotel = $room->hotel;

        $response = $this->actingAs($user)->put(route('rooms.update', $room->id), [
            'hotel_id' => $hotel->id,
            'name' => 'Quarto 2',
            'description' => 'Descrição do quarto 2',
        ]);

        $response->assertRedirect(route('hotels.show', $room->hotel_id));
    }

    public function testDestroy()
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();

        $response = $this->actingAs($user)->delete(route('rooms.destroy', $room->id));

        $response->assertRedirect(route('hotels.show', $room->hotel_id));
    }
}
