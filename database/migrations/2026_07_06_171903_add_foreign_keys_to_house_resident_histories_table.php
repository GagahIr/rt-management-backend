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
        Schema::table('house_resident_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('id_house')->change();
            $table->unsignedBigInteger('id_resident')->change();

            $table->foreign('id_house')->references('id')->on('houses')->onDelete('cascade');
            $table->foreign('id_resident')->references('id')->on('residents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('house_resident_histories', function (Blueprint $table) {
            $table->dropForeign('house_resident_histories_id_house_foreign');
            $table->dropForeign('house_resident_histories_id_resident_foreign');

            $table->integer('id_house')->change();
            $table->integer('id_resident')->change();
        });
    }
};
