<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('specialization');
            $table->string('license_number')->unique();
            $table->string('phone')->nullable();
            $table->string('office_address')->nullable();
            $table->string('office_city')->nullable();
            $table->string('office_state')->nullable();
            $table->string('office_postal_code')->nullable();
            $table->string('office_country')->nullable();
            $table->longText('bio')->nullable();
            $table->integer('years_of_experience')->nullable();
            $table->longText('qualifications')->nullable();
            $table->decimal('consultation_fee', 8, 2)->nullable();
            $table->time('availability_start_time')->nullable();
            $table->time('availability_end_time')->nullable();
            $table->longText('available_days')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
