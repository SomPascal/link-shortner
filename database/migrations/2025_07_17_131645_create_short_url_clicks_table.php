<?php

use App\Models\ShortUrl;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('short_url_clicks', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(ShortUrl::class)->constrained();
            $table->timestamp('clicked_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('short_url_clicks', function (Blueprint $table) {
            $table->dropForeignIdFor(ShortUrl::class);
        });

        Schema::dropIfExists('short_url_clicks');
    }
};
