<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UrlShortenerTest extends TestCase
{
    use RefreshDatabase;

    protected const TEST_LINK = 'ttps://glotelho.cm';

    public function test_shorten_and_redirect(): void
    {
        $fake_user = User::fakeOne();
        Sanctum::actingAs($fake_user);

        $response = $this->withCredentials()->postJson(route('api.short_url.make'), [
            'url' => self::TEST_LINK
        ]);

        $response->assertStatus(200)->assertJsonStructure([
            'short_url',
            'short_code'
        ]);

        $shortCode = $response->json('short_code');

        $this->get("/$shortCode")->assertRedirect(self::TEST_LINK);

        $stats = $this->getJson(route('api.short_url.stats', ['short_code' => $shortCode]));

        $stats->assertStatus(200)->assertJson([
            'click_count' => 1
        ]);
    }
}
