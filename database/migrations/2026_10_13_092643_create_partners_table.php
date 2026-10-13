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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->enum('registration_type', ['EP', 'GP']);
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('state')->nullable();
            $table->string('district')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->string('aadhaar_number');
            $table->string('aadhaar_front_image')->nullable();
            $table->string('aadhaar_back_image')->nullable();
            $table->string('pancard_number');
            $table->string('pancard_front_image')->nullable();
            $table->string('pancard_back_image')->nullable();
            $table->string('bank_account_number');
            $table->string('bank_name');
            $table->string('ifsc_code');
            $table->string('self_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
