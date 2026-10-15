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
            $table->string('address')->nullable()->after('phone');
            $table->string('city', 100)->nullable()->after('address');
            $table->string('state', 50)->nullable()->after('city');
            $table->string('zip_code', 20)->nullable()->after('state');
            $table->boolean('paperless_billing')->default(true)->after('zip_code');
            $table->json('notification_preferences')->nullable()->after('paperless_billing');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'address',
                'city',
                'state',
                'zip_code',
                'paperless_billing',
                'notification_preferences',
            ]);
        });
    }
};
