<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained()->onDelete('cascade');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->integer('duration_minutes')->default(30);
            $table->enum('status', ['scheduled', 'confirmed', 'completed', 'cancelled', 'no-show'])->default('scheduled');
            $table->string('reason_for_visit')->nullable();
            $table->longText('notes')->nullable();
            $table->string('cancellation_reason')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->boolean('reminder_sent')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
