<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition(): array
    {
        return [
            'plate_number' => strtoupper(fake()->bothify('??-####')),
            'model' => fake()->randomElement(['Toyota Hilux', 'Ford Ranger', 'Nissan Navara', 'Mitsubishi L200']),
            'passenger_capacity' => fake()->numberBetween(2, 7),
            'vehicle_status' => 'AVAILABLE',
            'disabled' => false,
        ];
    }
}
