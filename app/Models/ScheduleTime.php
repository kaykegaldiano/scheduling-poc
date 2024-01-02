<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleTime extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['user_id', 'schedule_date', 'schedule_hour'];
}
