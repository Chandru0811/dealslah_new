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
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('shipping', 20, 6)->nullable();
            $table->decimal('packaging', 20, 6)->nullable();
            $table->decimal('handling', 20, 6)->nullable();
            $table->decimal('taxes', 20, 6)->nullable();
            $table->decimal('grand_total', 20, 6)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('shipping');
            $table->dropColumn('packaging');
            $table->dropColumn('handling');
            $table->dropColumn('taxes');
            $table->dropColumn('grand_total');
        });
    }
};
