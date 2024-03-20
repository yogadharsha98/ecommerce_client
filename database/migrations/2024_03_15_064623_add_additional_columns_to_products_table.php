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
        Schema::table('products', function (Blueprint $table) {
            $table->string('si_upc')->nullable();
            $table->string('barcode_sku')->nullable();
            $table->string('b_m')->nullable();
            $table->string('product_name')->nullable();
            $table->text('product_description')->nullable();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('sub_group_id');
            $table->string('kg_ml')->nullable();
            $table->integer('units')->nullable();
            $table->string('ps')->nullable();
            $table->integer('case')->nullable();
            $table->string('dimensions')->nullable();
            $table->string('cp_vat')->nullable();
            $table->string('is')->nullable();
            $table->string('lo')->nullable();
            $table->string('ar')->nullable();
            $table->string('vat')->nullable();
            $table->string('wscp_vat')->nullable();
            $table->string('samson_percent')->nullable();
            $table->string('unit_rrp')->nullable();
            $table->string('rupm')->nullable();
            $table->integer('bcqty_1')->nullable();
            $table->string('bcp_1')->nullable();
            $table->string('b_percent_1')->nullable();
            $table->integer('bcqty_2')->nullable();
            $table->string('bcp_2')->nullable();
            $table->string('b_percent_2')->nullable();
            $table->integer('bcqty_3')->nullable();
            $table->string('bcp_3')->nullable();
            $table->string('b_percent_3')->nullable();
            $table->string('linked_item_1')->nullable();
            $table->string('linked_item_2')->nullable();
            $table->string('linked_item_3')->nullable();

            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('group')->onDelete('cascade');
            $table->foreign('sub_group_id')->references('id')->on('sub_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
