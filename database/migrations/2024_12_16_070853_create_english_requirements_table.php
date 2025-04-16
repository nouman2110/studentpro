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
        Schema::create('english_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('university_id')->constrained()->onDelete('cascade'); // Foreign key to universities
            $table->string('test_name'); // e.g., IELTS, TOEFL
            $table->string('minimum_score'); // e.g., 6.5
            $table->integer('validity_period')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('english_requirements');
    }
};
