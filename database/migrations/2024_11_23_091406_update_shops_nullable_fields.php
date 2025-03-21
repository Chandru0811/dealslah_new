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
        Schema::table('shops', function (Blueprint $table) {
            $table->string('shop_lattitude')->nullable();
            $table->string('shop_longtitude')->nullable();
        });

        // If "active" means setting a default value
        Schema::table('shops', function (Blueprint $table) {
            $table->string('shop_lattitude')->nullable()->default('active')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->dropColumn(['shop_lattitude', 'shop_longtitude']);
        });
    }
};
