<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adds optional Japanese variants of the admin-entered text.
 *
 * All nullable — the public site falls back to the English column whenever a
 * Japanese value is blank, so existing records keep working untouched.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('title_ja')->nullable()->after('title');
            $table->text('description_ja')->nullable()->after('description');
        });

        Schema::table('news', function (Blueprint $table) {
            $table->string('title_ja')->nullable()->after('title');
            $table->longText('content_ja')->nullable()->after('content');
        });

        Schema::table('heroes', function (Blueprint $table) {
            $table->string('title_ja')->nullable()->after('title');
            $table->string('button_cta_ja')->nullable()->after('button_cta');
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['title_ja', 'description_ja']);
        });

        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn(['title_ja', 'content_ja']);
        });

        Schema::table('heroes', function (Blueprint $table) {
            $table->dropColumn(['title_ja', 'button_cta_ja']);
        });
    }
};
