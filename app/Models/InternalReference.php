<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 

class InternalReference extends Model
{
    protected $fillable = ['ref_code'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
