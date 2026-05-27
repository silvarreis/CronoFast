<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'active'
    ];
    protected function status(): Attribute
    {
        return Attribute::get(
            fn () => $this->active ? 'active' : 'inactive'
        );
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
