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
            $table->string('name');
            $table->string('provider_name')->nullable();
            $table->string('provider_cricos_code')->nullable();

            $table->string('study_level')->nullable();
            $table->string('duration')->nullable();
            $table->string('sector')->nullable();

            $table->string('cricos_course_code')->nullable();
            $table->string('dual_qualification')->nullable();

            $table->string('broad_field')->nullable();
            $table->string('narrow_field')->nullable();
            $table->string('detailed_field')->nullable();

            $table->string('course_level')->nullable();
            $table->boolean('foundation_study')->default(false);
            $table->boolean('work_component')->default(false);
            $table->string('language')->nullable();

            $table->integer('duration_weeks')->nullable();
            $table->decimal('tuition_fee', 10, 2)->nullable();
            $table->decimal('non_tuition_fee', 10, 2)->nullable();
            $table->decimal('estimated_total_cost', 12, 2)->nullable();

            $table->string('course_location');
            $table->string('state')->nullable();

            $table->string('institution_name')->nullable();
            $table->string('institution_trading_name')->nullable();
            $table->string('institution_type')->nullable();
            $table->integer('institution_total_capacity')->nullable();
            $table->string('institution_website')->nullable();
            $table->text('institution_postal_address')->nullable();

            // Student contact
            $table->string('student_contact_name')->nullable();
            $table->string('student_contact_title')->nullable();
            $table->string('student_contact_phone')->nullable();
            $table->string('student_contact_fax')->nullable();
            $table->string('student_contact_email')->nullable();

            // Head contact
            $table->string('head_name')->nullable();
            $table->string('head_title')->nullable();
            $table->string('head_phone')->nullable();
            $table->string('head_fax')->nullable();
            $table->string('head_email')->nullable();

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
