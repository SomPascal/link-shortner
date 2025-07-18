<?php

namespace Database\Seeders;

use App\Constants\Test;
use App\Models\User;
use App\Services\ShortUrlService\ShortUrlService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    public function __construct(
        protected ShortUrlService $shortUrlService
    ) {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fake_user = User::fakeOne();
        User::factory(10)->create();

        if (empty($fake_user)) {
            $fake_user = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

            $shortUrl = $this->shortUrlService->create(
                'https://google.com', 
                user_id: $fake_user->id
            );
        }
    }
}
