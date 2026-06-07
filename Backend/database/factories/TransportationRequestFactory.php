<?php

namespace Database\Factories;

use App\Models\TransportationRequest;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TransportationRequestFactory extends Factory
{
    protected $model = TransportationRequest::class;

    public function definition(): array
    {
        return [
            'requester_id' => Employee::factory(),
            'passenger_count' => fake()->numberBetween(1, 5),
            'requested_departure_datetime' => now()->addDays(fake()->numberBetween(1, 7)),
            'requested_return_datetime' => now()->addDays(fake()->numberBetween(8, 14)),
            'status' => 'PENDING',
            'disabled' => false,
        ];
    }
}
