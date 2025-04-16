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
        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedBigInteger('study_level_id')->nullable()->after('commission');
            $table->foreign('study_level_id')->references('id')->on('study_levels')->onDelete('set null');
            $table->string('scholarship_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['study_level_id']);
            $table->dropColumn('study_level_id');
            $table->dropColumn('scholarship_amount');
        });
    }
};
