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
        Schema::create('available_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->date('date');
            $table->time('start_time');  // ✅ add this
            $table->time('end_time');    // ✅ add this
            $table->enum('status', ['available', 'booked'])->default('available');
            $table->timestamps();
        
            $table->unique(['doctor_id', 'date', 'start_time']); // ✅ time की जगह start_time को unique बनाया
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('available_slots');
    }
};
