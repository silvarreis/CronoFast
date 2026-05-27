<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $fillable = [
        'time_part_id',
        'lap_number',
        'total_time',
        'lap_time'
    ];
    public function timePart()
    {
        return $this->belongsTo(TimePart::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
