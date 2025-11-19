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
        $table->string('mollie_customer_id')->nullable();
        $table->string('mollie_mandate_id')->nullable();
        $table->decimal('tax_percentage', 6, 4)->default(0); // optional
        $table->dateTime('trial_ends_at')->nullable(); // optional
        $table->text('extra_billing_information')->nullable(); // optional
        $table->string('company_name')->nullable(); // optional
        $table->string('address')->nullable(); // optional
        $table->string('house_number')->nullable(); // optional
        $table->string('house_number_suffix')->nullable(); // optional
        $table->string('postal_code')->nullable(); // optional
        $table->string('city')->nullable(); // optional
        $table->string('country')->nullable(); // optional
        $table->string('vat_number')->nullable(); // optional
        $table->string('phone_number')->nullable(); // optional
        $table->string('domain')->nullable(); // optional]
        $table->string('places_id')->nullable(); // optional
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'mollie_customer_id',
                'mollie_mandate_id',
                'tax_percentage',
                'trial_ends_at',
                'extra_billing_information',
            ]);
        });
    }
};
