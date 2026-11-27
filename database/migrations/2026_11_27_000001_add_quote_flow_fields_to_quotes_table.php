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
        Schema::table('quotes', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('name');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('business_name')->nullable()->after('last_name');
            $table->json('coverages')->nullable()->after('type_label');
            $table->string('business_type')->nullable()->after('coverages');
            $table->string('business_type_other')->nullable()->after('business_type');
            $table->text('business_description')->nullable()->after('business_type_other');
            $table->string('employees')->nullable()->after('business_description');
            $table->string('years_in_business')->nullable()->after('employees');
            $table->string('annual_revenue')->nullable()->after('years_in_business');
            $table->string('business_address')->nullable()->after('annual_revenue');
            $table->string('location_ownership')->nullable()->after('business_address');
            $table->json('modular_data')->nullable()->after('location_ownership');
            $table->string('renewal_timeline')->nullable()->after('modular_data');
            $table->string('current_carrier')->nullable()->after('renewal_timeline');
            $table->string('claims_history')->nullable()->after('current_carrier');
            $table->string('bundle_preference')->nullable()->after('claims_history');
            $table->json('tags')->nullable()->after('bundle_preference');
            $table->json('raw_answers')->nullable()->after('tags');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name',
                'business_name',
                'coverages',
                'business_type',
                'business_type_other',
                'business_description',
                'employees',
                'years_in_business',
                'annual_revenue',
                'business_address',
                'location_ownership',
                'modular_data',
                'renewal_timeline',
                'current_carrier',
                'claims_history',
                'bundle_preference',
                'tags',
                'raw_answers',
            ]);
        });
    }
};
