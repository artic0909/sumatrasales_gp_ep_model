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
        if (!Schema::hasTable('lead_followups')) {
            Schema::create('lead_followups', function (Blueprint $table) {
                $table->id();
                $table->foreignId('lead_id')->constrained('leads')->onDelete('cascade');
                $table->string('type', 30)->default('calling'); // calling, whatsapp, both, other
                $table->text('notes')->nullable();
                $table->string('status', 50)->nullable(); // interested, callback, no_answer, not_interested, converted, pending
                $table->timestamp('followup_date')->useCurrent();
                $table->timestamp('next_followup_date')->nullable();
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('created_by_name')->nullable();
                $table->timestamps();

                $table->index('lead_id');
                $table->index('type');
                $table->index('followup_date');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_followups');
    }
};
