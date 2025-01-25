<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create 25 posts
        Post::factory(25)->create()->each(function ($post) {
            // Attach random tags to each post
            $tags = Tag::inRandomOrder()->take(rand(1, 5))->pluck('id');
            $post->tags()->attach($tags);
        });
    }
}
