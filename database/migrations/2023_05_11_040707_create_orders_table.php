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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customers_id');
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('pincode');
            $table->string('coupon_code')->nullable();
            $table->integer('coupon_value')->nullable();
            $table->integer('order_status');
            $table->enum('payment_type', ['COD', 'Gateway']);
            $table->string('payment_status');
            $table->string('payment_id')->nullable();
            $table->string('txn_id')->nullable();
            $table->string('total_amt');
            $table->string('track_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
