<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transmitter extends Model
{
    use HasFactory;
     //membuat variable
     protected $fillable = ['imei_number','gsm_number','team_id'];
}
