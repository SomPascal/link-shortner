<?php

namespace Database\Seeders;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShortUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::limit(30)->get();

        foreach ($users as $user) {
            $shortUrl = ShortUrl::factory(2)
            ->byUserId($user->id)
            ->create();
        }
    }
}
