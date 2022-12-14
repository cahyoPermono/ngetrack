<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transmitter extends Model
{
    use HasFactory;
     //membuat variable
     protected $fillable = ['nama','type','brand','stock','condition','weight'];
}
