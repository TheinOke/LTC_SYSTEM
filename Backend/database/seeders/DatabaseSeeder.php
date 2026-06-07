<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Vehicle;
use App\Models\TransportationRequest;
use App\Models\RouteStop;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Roles
        $adminRole = Role::factory()->create([
            'role_code' => 'ADMIN',
            'role_name' => 'System Administrator',
        ]);

        $driverRole = Role::factory()->create([
            'role_code' => 'DRIVER',
            'role_name' => 'Vehicle Driver',
        ]);

        // 2. Employees & User Accounts
        $employees = Employee::factory(10)->create();
        
        foreach ($employees as $employee) {
            $user = User::factory()->create([
                'employee_id' => $employee->id,
            ]);
            
            // Assign roles
            $user->roles()->attach(fake()->randomElement([$adminRole->id, $driverRole->id]));
        }

        // 3. Vehicles
        Vehicle::factory(5)->create();

        // 4. Transportation Requests & Route Stops
        TransportationRequest::factory(5)->create()->each(function ($request) {
            RouteStop::create([
                'request_id' => $request->id,
                'location_name' => fake()->city(),
                'sequence_number' => 1,
                'route_type' => 'PICKUP',
                'disabled' => false,
            ]);
            
            RouteStop::create([
                'request_id' => $request->id,
                'location_name' => fake()->city(),
                'sequence_number' => 2,
                'route_type' => 'DROPOFF',
                'disabled' => false,
            ]);
        });
    }
}
