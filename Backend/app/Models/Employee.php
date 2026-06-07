<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'disabled',
    ];

    protected $casts = [
        'disabled' => 'boolean',
    ];

    public function userAccount()
    {
        return $this->hasOne(User::class, 'employee_id');
    }

    public function driverProfile()
    {
        return $this->hasOne(DriverProfile::class, 'employee_id');
    }
}
