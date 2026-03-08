<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('id');
            $table->string('sku')->nullable()->after('name');
            $table->decimal('sale_price', 10, 2)->nullable()->after('price');
            $table->text('description')->nullable()->after('stock');
            $table->string('image')->nullable()->after('description');
            $table->boolean('is_active')->default(1)->after('image');
            $table->boolean('is_delete')->default(0)->after('is_active');

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn([
                'category_id',
                'sku',
                'sale_price',
                'description',
                'image',
                'is_active',
                'is_delete'
            ]);
        });
    }
};
