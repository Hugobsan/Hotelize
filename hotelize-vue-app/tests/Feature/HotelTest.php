<?php

namespace Tests\Feature;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HotelTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('hotels.index'));

        $response->assertStatus(200);
    }

    public function testStore()
    {
        $user = User::factory()->create();

        $hotel = Hotel::factory()->make();

        $response = $this->actingAs($user)->post(route('hotels.store'), $hotel->toArray());

        $response->assertRedirect(route('hotels.index'));
    }

    public function testShow()
    {
        $user = User::factory()->create();

        $hotel = Hotel::factory()->create();

        $response = $this->actingAs($user)->get(route('hotels.show', $hotel->id));

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $user = User::factory()->create();

        $hotel = Hotel::factory()->create();

        $hotel->name = 'Hotel Alterado';

        $response = $this->actingAs($user)->put(route('hotels.update', $hotel->id), $hotel->toArray());

        $response->assertRedirect(route('hotels.index'));
    }

    public function testDestroy()
    {
        $user = User::factory()->create();

        $hotel = Hotel::factory()->create();

        $response = $this->actingAs($user)->delete(route('hotels.destroy', $hotel->id));

        $response->assertRedirect(route('hotels.index'));
    }

    public function testValidation()
    {
        $user = User::factory()->create();

        $hotel = Hotel::factory()->make(['name' => '']);

        $response = $this->actingAs($user)->post(route('hotels.store'), $hotel->toArray());

        $response->assertSessionHasErrors('name');
    }

    public function testValidationUpdate()
    {
        $user = User::factory()->create();

        $hotel = Hotel::factory()->create();
        $hotel->name = '';

        $response = $this->actingAs($user)->put(route('hotels.update', $hotel->id), $hotel->toArray());

        $response->assertSessionHasErrors('name');
    }
}
