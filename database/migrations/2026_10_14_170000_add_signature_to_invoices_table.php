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
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('signatory_name')->nullable()->after('notes');
            $table->string('signatory_title')->nullable()->after('signatory_name');
            $table->longText('signature_image')->nullable()->after('signatory_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn(['signatory_name', 'signatory_title', 'signature_image']);
        });
    }
};
