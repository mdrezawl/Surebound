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
        Schema::table('claims', function (Blueprint $table) {
            $table->string('claimant_email')->nullable()->after('claimant_name');
            $table->string('claimant_phone')->nullable()->after('claimant_email');
            $table->date('incident_date')->nullable()->after('claimant_phone');
            $table->string('incident_type')->nullable()->after('incident_date');
            $table->string('incident_location')->nullable()->after('incident_type');
            $table->text('adjuster_notes')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('claims', function (Blueprint $table) {
            $table->dropColumn([
                'claimant_email',
                'claimant_phone',
                'incident_date',
                'incident_type',
                'incident_location',
                'adjuster_notes',
            ]);
        });
    }
};
