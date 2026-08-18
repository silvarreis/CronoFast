<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Employee;
use App\Models\InternalReference;
use App\Models\Operation;
use App\Models\Time;
use App\Models\TimePart;
use App\Models\Machine;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function refInternal()
    {
        return $this->hasMany(InternalReference::class);
    }
    public function operation()
    {
        return $this->hasMany(Operation::class);
    }
    public function times()
    {
        return $this->hasMany(Time::class);
    }
    public function timeparts()
    {
        return $this->hasMany(TimePart::class);
    }
    public function machine()
    {
        return $this->hasMany(Machine::class);
    }
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class)
            ->where('status', 'active')
            ->where('expires_at', '>', now());
    }
}
