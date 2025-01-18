<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;  // Import Sanctum's HasApiTokens

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;  // Add HasApiTokens to enable Sanctum token management

    protected $fillable = ['name', 'email', 'password'];
}
