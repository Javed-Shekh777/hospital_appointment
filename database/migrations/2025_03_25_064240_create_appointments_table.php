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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->foreignId('slot_id')->constrained('available_slots')->onDelete('cascade');
            $table->enum('status',['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->enum('payment_status',['pending', 'paid', 'failed'])->default('pending');
            $table->timestamps();
            $table->unique('slot_id');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
