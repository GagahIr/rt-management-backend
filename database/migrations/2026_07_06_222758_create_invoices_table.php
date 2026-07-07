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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('house_id')->constrained('houses')->onDelete('cascade');
            $table->foreignId('resident_id')->constrained('residents')->onDelete('cascade');
            $table->foreignId('payment_type_id')->constrained('payment_types')->onDelete('cascade');

            $table->integer('amount');

            $table->unsignedTinyInteger('period_month');
            $table->unsignedSmallInteger('period_year');

            $table->enum('status', ['Belum lunas', 'Lunas'])->default('Belum lunas');
            $table->date('payment_date')->nullable();

            $table->timestamps();

            $table->unique(['house_id', 'payment_type_id', 'period_month', 'period_year'], 'unique_monthly_invoice');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
