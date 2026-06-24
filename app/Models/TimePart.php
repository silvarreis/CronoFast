<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimePart extends Model
{
    protected $fillable = [
        'internal_reference_id',
        'employee_id',
        'operation_id',
        'machine_id',
        'center_work',
        'margin_value',
        'production_pace',
        'num_repetition'
    ];
    public function times()
    {
        return $this->hasMany(Time::class)->orderBy('lap_number');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function internalReference()
    {
        return $this->belongsTo(InternalReference::class);
    }
    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }
    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getRefInternal($value)
    {
        return InternalReference::find($value);
    }
    
}
