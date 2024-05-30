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
            $table->string('mobile')->after('remember_token')->nullable();
            $table->longText('address')->after('mobile')->nullable();
            $table->string('city')->after('address')->nullable();
            $table->string('state')->after('city')->nullable();
            $table->string('zip')->after('state')->nullable();
            $table->string('company')->after('zip')->nullable();
            $table->string('is_verify')->after('company')->nullable();
            $table->string('is_forgot_password')->after('is_verify')->nullable();
            $table->string('rand_id')->after('is_forgot_password')->nullable();
            $table->enum('status', ['0', '1'])->default(0)->comment('0=>Active,1=>Deactive')->after('rand_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
