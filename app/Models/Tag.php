<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relation - a tag can be associated with many posts
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
