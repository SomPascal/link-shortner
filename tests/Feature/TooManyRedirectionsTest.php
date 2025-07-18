<?php

namespace Tests\Feature;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TooManyRedirectionsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_too_many_redirections_response(): void
    {
        $fakeUrl = User::factory()->create();

        $shortUrl = ShortUrl::factory()->create([
            'user_id' => $fakeUrl->id
        ]);

        $response = null;

        for ($i=0; $i < 50; $i++) { 
            $response = $this->get(route('url.redirect', [
                'short_code' => $shortUrl->short_code
            ]));
        }

        $response->assertStatus(429);
    }
}
