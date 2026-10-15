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
        Schema::table('policies', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id')->index();
            $table->string('holder_email')->nullable()->after('holder_name');
            $table->string('holder_phone')->nullable()->after('holder_email');
            $table->string('deductible')->default('$1,000')->after('coverage_limit');
            $table->string('billing_frequency')->default('Annual')->after('annual_premium');
            $table->string('insured_item')->nullable()->after('type_label');
            $table->string('carrier')->default('Surebound Mutual Underwriting Co.')->after('type_label');
            $table->json('coverage_details')->nullable()->after('status');
            $table->string('policy_document')->nullable()->after('coverage_details');
            $table->text('notes')->nullable()->after('policy_document');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('policies', function (Blueprint $table) {
            $table->dropColumn([
                'user_id',
                'holder_email',
                'holder_phone',
                'deductible',
                'billing_frequency',
                'insured_item',
                'carrier',
                'coverage_details',
                'policy_document',
                'notes',
            ]);
        });
    }
};
