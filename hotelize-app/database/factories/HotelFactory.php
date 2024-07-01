<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $valid_ceps = [
            '01001000', '02011000', '03047000', '04020000', '05010000',
            '06018000', '07044000', '08021000', '09061530', '11030130',
            '12216010', '13010010', '14010020', '15015010', '16010710',
            '17012110', '18035300', '19010000', '20040002', '21010020',
            '22221001', '23050110', '24020001', '25010030', '26030050',
            '29010015', '30010012', '40010000', '50010000', '60060170'
        ]; 

        return [
            'name' => $this->faker->company,
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'zip_code' => $this->faker->randomElement($valid_ceps),
            'website' => $this->faker->url,
        ];
    }
}
