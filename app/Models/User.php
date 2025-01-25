<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = ['name', 'email', 'password'];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // Automatically create a profile when a user is created
    protected static function booted()
    {
        static::created(function ($user) {
            $user->profile()->create([
                'bio' => 'Welcome To Laravel',  
                'avatar' => '',  
            ]);
        });
    }
}
