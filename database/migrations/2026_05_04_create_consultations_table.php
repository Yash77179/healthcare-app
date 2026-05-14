<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained()->onDelete('cascade');
            $table->date('consultation_date');
            $table->time('consultation_time');
            $table->string('diagnosis')->nullable();
            $table->longText('symptoms')->nullable();
            $table->longText('treatment_plan')->nullable();
            $table->longText('medications_prescribed')->nullable();
            $table->longText('tests_recommended')->nullable();
            $table->boolean('follow_up_required')->default(false);
            $table->date('follow_up_date')->nullable();
            $table->longText('notes')->nullable();
            $table->enum('consultation_type', ['in-person', 'telehealth', 'video-call', 'phone'])->default('in-person');
            $table->longText('consultation_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
