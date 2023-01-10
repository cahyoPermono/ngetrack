<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function vehicleRoutes(){
        return $this->hasMany(VehicleRoute::class);
    }

    public function activeRoutes(){
        return $this->hasOne(VehicleRoute::class)->latest();
    }

    public function vehiclePictures(){
        return $this->hasMany(VehiclePicture::class);
    }
}
