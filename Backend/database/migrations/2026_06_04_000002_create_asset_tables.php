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
        Schema::create('employee_driver_profiles', function (Blueprint $table) {
            $table->foreignId('employee_id')->primary()->constrained('employees')->onDelete('cascade');
            $table->string('license_number');
            $table->date('license_expiry');
            $table->float('daily_working_hours')->default(0);
            $table->float('weekly_overtime_hours')->default(0);
            $table->boolean('disabled')->default(false);
            $table->timestamps();
        });

        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('plate_number')->unique();
            $table->string('model');
            $table->integer('passenger_capacity');
            $table->string('vehicle_status');
            $table->boolean('disabled')->default(false);
            $table->timestamps();
        });

        Schema::create('maintenance_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->date('scheduled_date');
            $table->string('service_type');
            $table->boolean('disabled')->default(false);
            $table->timestamps();
        });

        Schema::create('operation_daily_sheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->date('operation_date');
            $table->float('fuel_liters')->default(0);
            $table->float('total_distance')->default(0);
            $table->boolean('disabled')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_daily_sheets');
        Schema::dropIfExists('maintenance_schedules');
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('employee_driver_profiles');
    }
};
