<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
             DB::table('university_names')->whereNull('qs_ranking')->update(['qs_ranking' => '']);
            DB::table('university_names')->whereNull('location')->update(['location' => '']);

            $table->string('qs_ranking')->nullable(false)->change(); 
            $table->text('location')->nullable(false)->change(); 
        });
    }
};
