<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleRoute extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function vehicleTracking()
    {
        return $this->hasMany(VehicleTracking::class)->latest();
    }
    public function lastTracking()
    {
        return $this->hasOne(VehicleTracking::class)->latest();
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function transmitter()
    {
        return $this->belongsTo(Transmitter::class);
    }
}
