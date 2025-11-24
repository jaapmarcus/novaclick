<?php

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
        Schema::table('users', function (Blueprint $table) {
            $table->string('x_handle')->nullable()->after('places_id');
            $table->string('facebook_handle')->nullable()->after('twitter_handle');
            $table->string('instagram_handle')->nullable()->after('facebook_handle');
            $table->string('tiktok_handle')->nullable()->after('instagram_handle');
            $table->string('linkedin_handle')->nullable()->after('tiktok_handle');
            $table->string('youtube_handle')->nullable()->after('linkedin_handle');
            $table->string('whatsapp_handle')->nullable()->after('youtube_handle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('x_handle');
            $table->dropColumn('facebook_handle');
            $table->dropColumn('instagram_handle');
            $table->dropColumn('tiktok_handle');
            $table->dropColumn('linkedin_handle');
            $table->dropColumn('youtube_handle');
            $table->dropColumn('whatsapp_handle');
        });
    }
};
