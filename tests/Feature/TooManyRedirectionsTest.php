<?php

namespace Tests\Feature;

use App\Models\ShortUrl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TooManyRedirectionsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_too_many_redirections_response(): void
    {
        $shortUrl = ShortUrl::first();

        $response = null;

        for ($i=0; $i < 50; $i++) { 
            $response = $this->get(route('url.redirect', [
                'short_code' => $shortUrl->short_code
            ]));
        }

        $response->assertStatus(429);
    }
}
