<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehiclePicture extends Model
{
    use HasFactory;

    protected $fillable = ['vehicle_id','url'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
