<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteStop extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'location_name',
        'sequence_number',
        'route_type',
        'disabled',
    ];

    protected $casts = [
        'disabled' => 'boolean',
    ];

    public function transportationRequest()
    {
        return $this->belongsTo(TransportationRequest::class, 'request_id');
    }
}
