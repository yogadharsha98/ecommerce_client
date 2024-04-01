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
        Schema::table('carts', function (Blueprint $table) {
            $table->integer('bcqty1')->nullable();
            $table->integer('bcqty2')->nullable();
            $table->integer('bcqty3')->nullable();
            $table->integer('vat')->nullable();
            $table->decimal('total_bulk1_price', 10, 2)->nullable();
            $table->decimal('total_bulk2_price', 10, 2)->nullable();
            $table->decimal('total_bulk3_price', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('bcqty1');
            $table->dropColumn('bcqty2');
            $table->dropColumn('bcqty3');
            $table->integer('vat')->nullable();
            $table->dropColumn('total_bulk1_price');
            $table->dropColumn('total_bulk2_price');
            $table->dropColumn('total_bulk3_price');
        });
    }
};
