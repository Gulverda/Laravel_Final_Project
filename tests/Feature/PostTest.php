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

        // Act: Create a post
        $response = $this->actingAs($user)->postJson('/api/posts', [
            'title' => 'Test Post',
            'content' => 'Test content',
        ]);

        // Assert post creation
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Post created successfully!']);

        // Assert that a notification was sent to the user
        Notification::assertSentTo(
            [$user], PostCreated::class
        );
    }
}
