<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TooManyShortnerTest extends TestCase
{
    use RefreshDatabase;

    protected const TEST_LINK = 'https://glotelo.com';

    public function test_too_many_shortner(): void
    {
        $fake_user = User::fakeOne();

        Sanctum::actingAs($fake_user);
        $response = null;

        for ($i=0; $i < 50; $i++) { 
            $response = $this->postJson(route('api.short_url.make'), [
                'url' => self::TEST_LINK
            ]);
        }

        $response->assertStatus(429);
    }
}
