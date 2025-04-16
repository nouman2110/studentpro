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
        Schema::table('users', function (Blueprint $table) {
            $table->string('legal_name')->nullable();
            $table->string('trading_name')->nullable();
            $table->string('abn_reg_no')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['legal_name','trading_name','abn_reg_no','address','phone']);
        });
    }
};
