<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'mp_preapproval_id',
        'mp_payment_id',
        'status',
        'starts_at',
        'trial_ends_at',
        'expires_at',
        'canceled_at'
    ];

    protected $casts = [
        'starts_at'     => 'datetime',
        'expires_at'    => 'datetime',
        'trial_ends_at' => 'datatime',
        'canceled_at'   => 'datatime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
