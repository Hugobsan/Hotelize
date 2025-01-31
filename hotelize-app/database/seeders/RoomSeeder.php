<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $hotels = Hotel::all();
        foreach ($hotels as $hotel) {
            Room::factory()->count(5)->create([
                'hotel_id' => $hotel->id,
            ]);
        }
    }
}
