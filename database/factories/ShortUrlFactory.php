<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShortUrl>
 */
class ShortUrlFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'original_url' => $this->faker->url(),
            'expire_at' => now()->addHours(random_int(2, 20)),
            'short_code' => Str::random(6)
        ];
    }

    public function byUserId(int $user_id): static
    {
        return $this->state(fn(array $attributes)=> [
            'user_id' => $user_id
        ]);
    }
}
