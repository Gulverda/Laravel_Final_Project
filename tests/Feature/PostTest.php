<?php
namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testPostCanBeCreated()
    {
        $user = User::factory()->create(); // Create a user
        $token = $user->createToken('TestToken')->plainTextToken; // Generate a token for the user
    
        // Ensure the request is sent to /api/posts, not /posts
        $response = $this->postJson('/api/posts', [
            'title' => 'Test Post',
            'content' => 'Test Content',
            'tags' => [1, 2], // Tags should exist in the database
        ], [
            'Authorization' => 'Bearer ' . $token
        ]);
    
        $response->assertStatus(201); // Expecting 201 Created
        $response->assertJson(['message' => 'Post created successfully!']);
        $this->assertDatabaseHas('posts', ['title' => 'Test Post']);
    }
    
}
