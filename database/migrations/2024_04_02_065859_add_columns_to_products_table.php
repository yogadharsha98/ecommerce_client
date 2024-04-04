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
            $table->tinyInteger('monthly_offer')->default('0')->comment('1=selected,0=not_selected');
            $table->tinyInteger('weekly_offer')->default('0')->comment('1=selected,0=not_selected');
            $table->tinyInteger('seasonal_offer')->default('0')->comment('1=selected,0=not_selected');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('monthly_offer');
            $table->dropColumn('weekly_offer');
            $table->dropColumn('seasonal_offer');
        });
    }
};
