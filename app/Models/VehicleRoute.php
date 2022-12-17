<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleRoute extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function vehicleTracking()
    {
        return $this->hasMany(VehicleTracking::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
