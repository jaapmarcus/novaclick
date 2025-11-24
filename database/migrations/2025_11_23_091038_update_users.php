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
            $table->string('wizard')->nullable()->after('places_id');
            $table->string('services_active')->nullable()->after('wizard');
            $table->string('username')->nullable()->after('domain');
            $table->string('sftp_password')->nullable()->after('username');
            $table->integer('server_id')->nullable()->after('sftp_password');
            $table->string('application_password')->nullable()->after('server_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['wizard', 'services_active']);
        });
    }
};
