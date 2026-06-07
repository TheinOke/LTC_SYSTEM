<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition(): array
    {
        $roleName = fake()->unique()->jobTitle();
        return [
            'role_code' => strtoupper(Str::slug($roleName, '_')),
            'role_name' => $roleName,
            'disabled' => false,
        ];
    }
}
