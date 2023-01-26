<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transmitter extends Model
{
    use HasFactory;
    use SoftDeletes;
     //membuat variable
     protected $fillable = ['imei_number','gsm_number','team_id'];
}
