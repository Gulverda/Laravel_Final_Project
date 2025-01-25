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
        $user = User::factory()->create(); 
        $token = $user->createToken('TestToken')->plainTextToken; 
    
        $response = $this->postJson('/api/posts', [
            'title' => 'Test Post',
            'content' => 'Test Content',
            'tags' => [1, 2],
        ], [
            'Authorization' => 'Bearer ' . $token
        ]);
    
        $response->assertStatus(201); 
        $response->assertJson(['message' => 'Post created successfully!']);
        $this->assertDatabaseHas('posts', ['title' => 'Test Post']);
    }
    
}
