<?php

namespace Tests\Feature;

use Tests\TestCase;

class UrlShortenerTest extends TestCase
{
    public function test_shorten_and_redirect(): void
    {
        define('TEST_LINK', 'https://glotelho.cm');

        $response = $this->postJson(route('api.short_url.make'), [
            'url' => TEST_LINK
        ]);

        $response->assertStatus(200)->assertJsonStructure([
            'short_url',
            'short_code'
        ]);

        $shortCode = $response->json('short_code');

        $this->get("/$shortCode")->assertRedirect(TEST_LINK);

        $stats = $this->getJson(route('api.short_url.stats', ['short_code' => $shortCode]));

        $stats->assertStatus(200)->assertJson([
            'click_count' => 1
        ]);
    }
}
