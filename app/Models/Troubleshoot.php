<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Troubleshoot extends Model
{
    use HasFactory;
    //membuat variable
    protected $fillable = ['source','imei','team_id','description'];
}
