<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'content'];

    // Relation - a post belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation - a post can have many tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
