<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'media')) {
                $table->dropColumn('media');
            }

            if (Schema::hasColumn('products', 'additional_details')) {
                $table->dropColumn('additional_details');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Re-add columns if needed
            if (!Schema::hasColumn('products', 'media')) {
                $table->json('media')->nullable();
            }

            if (!Schema::hasColumn('products', 'additional_details')) {
                $table->text('additional_details')->nullable();
            }
        });
    }
};
