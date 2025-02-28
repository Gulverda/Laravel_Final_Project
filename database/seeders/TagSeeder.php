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

        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }
    }
}
