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
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('user_id')->nullable();

            $table->string('product_id')->nullable();
            $table->string('product_title')->nullable();
            $table->string('department_title')->nullable();
            $table->string('group_title')->nullable();
            $table->string('sub_group_title')->nullable();

            $table->string('quantity')->nullable();
            $table->string('total_unit_price')->nullable();
            $table->string('case')->nullable();
            $table->string('total_case_price')->nullable();


            $table->string('bcqty1')->nullable();
            $table->string('total_bulk1_price')->nullable();
            $table->string('bcqty2')->nullable();
            $table->string('total_bulk2_price')->nullable();
            $table->string('bcqty3')->nullable();
            $table->string('total_bulk3_price')->nullable();
            $table->string('vat')->nullable();

            $table->string('payment_status')->nullable();
            $table->string('delivery_status')->nullable();


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
