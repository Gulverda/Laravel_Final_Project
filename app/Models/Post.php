<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'content'];

    // რელაცია - ერთი მომხმარებელი ბევრ პოსტს ქმნის
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
