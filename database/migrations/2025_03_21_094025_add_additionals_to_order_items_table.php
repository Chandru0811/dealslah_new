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
        Schema::table('order_items', function (Blueprint $table) {
            $table->string('coupon_code')->nullable()->after('delivery_date');
            $table->decimal('discount', 20, 6)->default(0)->after('coupon_code');
            $table->decimal('discount_percent', 20, 6)->default(0)->after('discount');
            $table->string('deal_type')->nullable()->after('discount_percent');
            $table->date('service_date')->nullable()->after('deal_type');
            $table->time('service_time')->nullable()->after('service_date');
            $table->decimal('shipping', 20, 6)->default(0)->after('service_time');
            $table->decimal('packaging', 20, 6)->default(0)->after('shipping');
            $table->decimal('handling', 20, 6)->default(0)->after('packaging');
            $table->decimal('taxes', 20, 6)->default(0)->after('handling');
            $table->decimal('shipping_weight', 20, 2)->default(0)->after('taxes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn([
                'coupon_code',
                'discount',
                'discount_percent',
                'deal_type',
                'service_date',
                'service_time',
                'shipping',
                'packaging',
                'handling',
                'taxes',
                'shipping_weight',
            ]);
        });
    }
};
