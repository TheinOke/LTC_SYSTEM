<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserAccountFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'username' => fake()->unique()->userName(),
            'password_hash' => Hash::make('password'),
            'is_active' => true,
            'disabled' => false,
        ];
    }
}
