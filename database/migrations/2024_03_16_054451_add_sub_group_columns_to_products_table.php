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
            $table->unsignedBigInteger('sub_group_id_1')->nullable();
            $table->unsignedBigInteger('sub_group_id_2')->nullable();
            $table->unsignedBigInteger('sub_group_id_3')->nullable();

            $table->foreign('sub_group_id_1')->references('id')->on('sub_groups')->onDelete('cascade');
            $table->foreign('sub_group_id_2')->references('id')->on('sub_groups')->onDelete('cascade');
            $table->foreign('sub_group_id_3')->references('id')->on('sub_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['sub_group_id_1']);
            $table->dropForeign(['sub_group_id_2']);
            $table->dropForeign(['sub_group_id_3']);
            $table->dropColumn(['sub_group_id_1', 'sub_group_id_2', 'sub_group_id_3']);
        });
    }
};
