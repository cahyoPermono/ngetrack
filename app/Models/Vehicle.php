<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function vehicleRoutes(){
        return $this->hasMany(VehicleRoute::class);
    }

    public function activeRoutes(){
        return $this->hasOne(VehicleRoute::class)->where('status','on')->latest();
    }

    public function vehiclePictures(){
        return $this->hasMany(VehiclePicture::class);
    }
}
