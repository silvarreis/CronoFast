<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'mp_plan_id',
        'active'
    ];
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
