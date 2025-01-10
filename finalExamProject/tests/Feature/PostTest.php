<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_can_be_created()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/posts', [
            'title' => 'Test Post',
            'content' => 'Test content',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Post created successfully!']);
    }
}
