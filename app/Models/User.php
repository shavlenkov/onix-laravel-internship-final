<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'status',
        'address',
        'password',
    ];

    public function quetions() {
        return $this->belongsToMany(Question::class, 'quetions', 'user_id', 'product_id');
    }

    public function isAdmin(): bool
    {
        return $this->status == 1;
    }

    public function isUser(): bool
    {
        return $this->status == 0;
    }

}
