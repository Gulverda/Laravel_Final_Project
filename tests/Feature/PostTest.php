<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use App\Notifications\PostCreated;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_can_be_created()
    {
        // Arrange: Authenticate a user
        $user = User::factory()->create();
    
        // Fake notifications
        Notification::fake();
    
        // Get Sanctum token for authentication
        $token = $user->createToken('TestToken')->plainTextToken;
    
        // Act: Create a post with authorization header
        $response = $this->postJson('/api/posts', [
            'title' => 'Test Post',
            'content' => 'Test content',
        ], [
            'Authorization' => 'Bearer ' . $token, // Send the token in the header
        ]);
    
        // Assert post creation
        $response->assertStatus(201);  // Assert the post creation returns 201 (created)
        $response->assertJson(['message' => 'Post created successfully!']);
        
        // Assert that the post is created in the database
        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
            'content' => 'Test content',
            'user_id' => $user->id,  // Make sure the post is associated with the authenticated user
        ]);
    
        // Assert that a notification was sent to the user
        Notification::assertSentTo(
            [$user], PostCreated::class
        );
    }
}
