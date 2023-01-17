<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Troubleshoot extends Model
{
    use HasFactory;
    //membuat variable
    protected $fillable = ['source','imei','team_id','description'];

    public function getCreatedAtAttribute($date)
    {
    return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('yyyy mm dd');
    }
}
