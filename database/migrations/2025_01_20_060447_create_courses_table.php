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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('study_level_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_name_id')->constrained()->onDelete('cascade');
            $table->string('annual_fee');
            $table->string('duration');
            $table->string('start_date');
            $table->string('study_mode');
            $table->string('accreditation')->nullable();
            $table->string('regional_area')->nullable();
            $table->string('country_requirement')->nullable();
            $table->string('regional_requirement')->nullable();
            $table->text('pathway_to_visa')->nullable();
            $table->text('admmision_req')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
