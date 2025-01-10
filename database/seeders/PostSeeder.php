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
        // Create 50 posts
        Post::factory(25)->create()->each(function ($post) {
            // Attach random tags to each post
            $tags = Tag::inRandomOrder()->take(rand(1, 5))->pluck('id'); // Get 1 to 5 random tags
            $post->tags()->attach($tags); // Attach the tags to the post
        });
    }
}
