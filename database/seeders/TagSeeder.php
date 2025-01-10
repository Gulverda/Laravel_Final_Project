<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define an array of sample tags
        $tags = [
            'Technology',
            'Programming',
            'Laravel',
            'PHP',
            'JavaScript',
            'CSS',
            'HTML',
            'Web Development',
            'Design',
            'Database'
        ];

        // Loop through the array and create each tag
        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }
    }
}
