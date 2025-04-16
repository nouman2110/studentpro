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
        Schema::table('university_names', function (Blueprint $table) {
            $table->string('qs_ranking')->nullable()->change(); 
            $table->text('location')->nullable()->change();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('university_names', function (Blueprint $table) {
            $table->string('qs_ranking')->nullable(false)->change(); 
            $table->text('location')->nullable(false)->change(); 
        });
    }
};
