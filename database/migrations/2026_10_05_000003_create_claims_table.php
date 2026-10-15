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
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->string('claim_number')->unique();
            $table->string('policy_number');
            $table->string('claimant_name');
            $table->text('incident_description');
            $table->string('estimated_loss')->default('$1,000');
            $table->string('assigned_adjuster')->default('Unassigned');
            $table->string('priority')->default('Normal'); // High, Normal, Low
            $table->string('status')->default('reviewing'); // reviewing, approved, paid, declined
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
