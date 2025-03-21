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
            if (!Schema::hasColumn('shops', 'shop_lattitude')) {
                $table->string('shop_lattitude', 255)->nullable();
            }

            if (!Schema::hasColumn('shops', 'is_direct')) {
                $table->boolean('is_direct')->default(1)->after('show_name_on_website');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shops', function (Blueprint $table) {
            if (Schema::hasColumn('shops', 'shop_lattitude')) {
                $table->dropColumn('shop_lattitude');
            }

            if (Schema::hasColumn('shops', 'is_direct')) {
                $table->dropColumn('is_direct');
            }
        });
    }
};
