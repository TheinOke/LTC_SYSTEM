<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_number',
        'model',
        'passenger_capacity',
        'vehicle_status',
        'disabled',
    ];

    protected $casts = [
        'disabled' => 'boolean',
    ];

    public function tripAssignments()
    {
        return $this->hasMany(TripAssignment::class);
    }
}
