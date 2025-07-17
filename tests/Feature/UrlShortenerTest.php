<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UrlShortenerTest extends TestCase
{
    public function test_shorten_and_redirect(): void
    {
        define('TEST_LINK', 'https://glotelho.cm');

        $response = $this->postJson('/api/shorten', [
            'url' => TEST_LINK
        ]);

        $response->assertStatus(200)->assertJsonStructure([
            'short_url',
            'short_code'
        ]);

        $shortCode = $response->json('short_code');

        $this->get("/$shortCode")->assertRedirect(TEST_LINK);

        $stats = $this->getJson("/api/stats/$shortCode");

        $stats->assertStatus(200)->assertJson([
            'click_count' => 1
        ]);
    }
}
