<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transportation_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requester_id')->constrained('employees')->onDelete('cascade');
            $table->integer('passenger_count');
            $table->dateTime('requested_departure_datetime');
            $table->dateTime('requested_return_datetime');
            $table->string('status');
            $table->boolean('disabled')->default(false);
            $table->timestamps();
        });

        Schema::create('route_stops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('transportation_requests')->onDelete('cascade');
            $table->string('location_name');
            $table->integer('sequence_number');
            $table->string('route_type');
            $table->boolean('disabled')->default(false);
            $table->timestamps();
        });

        Schema::create('trip_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('transportation_requests')->onDelete('cascade');
            $table->dateTime('scheduled_start');
            $table->dateTime('scheduled_end');
            $table->boolean('disabled')->default(false);
            $table->timestamps();
        });

        Schema::create('trip_vehicles', function (Blueprint $table) {
            $table->foreignId('trip_assignment_id')->constrained('trip_assignments')->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->primary(['trip_assignment_id', 'vehicle_id']);
        });

        Schema::create('assignment_drivers', function (Blueprint $table) {
            $table->foreignId('trip_assignment_id')->constrained('trip_assignments')->onDelete('cascade');
            $table->foreignId('driver_employee_id')->constrained('employee_driver_profiles', 'employee_id')->onDelete('cascade');
            $table->primary(['trip_assignment_id', 'driver_employee_id']);
        });

        Schema::create('inspection_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->foreignId('inspector_id')->constrained('employees')->onDelete('cascade');
            $table->json('checklist_results');
            $table->boolean('disabled')->default(false);
            $table->timestamps();
        });

        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('status');
            $table->boolean('disabled')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
        Schema::dropIfExists('inspection_logs');
        Schema::dropIfExists('assignment_drivers');
        Schema::dropIfExists('trip_vehicles');
        Schema::dropIfExists('trip_assignments');
        Schema::dropIfExists('route_stops');
        Schema::dropIfExists('transportation_requests');
    }
};
