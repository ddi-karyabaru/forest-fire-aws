<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorLog extends Model
{
    protected $fillable = [
    'temperature', 
    'humidity', 
    'soil_moisture', 
    'mq2_value', 
    'flame_status', 
    'status_warning'
];
}
