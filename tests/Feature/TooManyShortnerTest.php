<?php

namespace Tests\Feature;

use App\Constants\Test;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TooManyShortnerTest extends TestCase
{
    use RefreshDatabase;

    protected const TEST_LINK = 'https://glotelo.com';

    public function test_too_many_shortner(): void
    {
        $fake_user = User::factory()->create([
            'name' => 'fake',
            'email' => Test::FAKE_USER_EMAIl,
            'password' => Hash::make('password')
        ]);

        Sanctum::actingAs($fake_user);
        $response = null;

        for ($i=0; $i < 100; $i++) { 
            $response = $this->postJson(route('api.short_url.make'), [
                'url' => self::TEST_LINK
            ]);
        }

        $response->assertStatus(429);
    }
}
