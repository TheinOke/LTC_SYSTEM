<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'requester_id',
        'passenger_count',
        'requested_departure_datetime',
        'requested_return_datetime',
        'status',
        'disabled',
    ];

    protected $casts = [
        'requested_departure_datetime' => 'datetime',
        'requested_return_datetime' => 'datetime',
        'disabled' => 'boolean',
    ];

    public function requester()
    {
        return $this->belongsTo(Employee::class, 'requester_id');
    }

    public function routeStops()
    {
        return $this->hasMany(RouteStop::class, 'request_id');
    }

    public function tripAssignments()
    {
        return $this->hasMany(TripAssignment::class, 'request_id');
    }
}
