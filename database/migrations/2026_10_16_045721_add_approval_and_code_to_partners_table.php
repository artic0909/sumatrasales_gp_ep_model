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
        Schema::table('partners', function (Blueprint $table) {
            $table->string('status', 20)->default('pending')->after('registration_type');
            $table->string('approved_code', 50)->nullable()->unique()->after('application_code');
            $table->timestamp('approved_at')->nullable()->after('approved_code');
            $table->text('rejection_reason')->nullable()->after('approved_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn(['status', 'approved_code', 'approved_at', 'rejection_reason']);
        });
    }
};
