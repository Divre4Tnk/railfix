<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => strtoupper(Str::random(6)),
            'name' => fake()->word(),
            'location_id' => Location::factory(),
            'serial_number' => strtoupper(Str::random(12)),
            'date_in' => fake()->date(),
            'date_out' => fake()->date(),
            'pic' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'status' => fake()->randomElement(['received', 'on_progress', 'done', 'returned', 'broken']),
            'description' => fake()->paragraph(),
        ];
    }
}
