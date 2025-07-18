<?php

namespace Tests\Feature;

use App\Constants\Test;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UrlShortenerTest extends TestCase
{
    use RefreshDatabase;

    protected const TEST_LINK = 'https://glotelho.cm';

    public function test_shorten_and_redirect(): void
    {
        $fake_user = User::factory()->create([
            'name' => 'fake',
            'email' => Test::FAKE_USER_EMAIl,
            'password' => Hash::make('password')
        ]);

        Sanctum::actingAs($fake_user);

        $response = $this->withoutMiddleware()->postJson(route('api.short_url.make'), [
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
