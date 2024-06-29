<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition($hotel_id = null): array
    {
        return [
            'hotel_id' => $hotel_id ?? \App\Models\Hotel::factory(),
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];
    }
}
