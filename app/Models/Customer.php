<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    //membuat variable
    protected $fillable = ['name_pt','address','name_pic','phone'];
}
