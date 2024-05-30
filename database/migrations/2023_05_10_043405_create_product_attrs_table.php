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
        Schema::create('product_attrs', function (Blueprint $table) {
            $table->id();
            $table->integer('products_id');
            $table->string('sku');
            $table->float('mrp', 8, 2);
            $table->float('price', 8, 2);
            $table->integer('qty');
            $table->integer('size_id');
            $table->integer('color_id');
            $table->longText('attr_image')->nullable();
            $table->longText('product_dimension');
            $table->longText('package_dimension');
            $table->longText('weight');
            $table->longText('shipping_weight');
            $table->longText('cautions');
            $table->longText('material');
            $table->longText('recommended_age');
            $table->enum('status', ['0', '1'])->default(0)->comment('0=>Active,1=>Deactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attrs');
    }
};
