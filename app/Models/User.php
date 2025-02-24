<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // ✅ Add this!

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // ✅ Make sure this is included

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
