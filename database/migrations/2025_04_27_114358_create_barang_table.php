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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembelians_id')->constrained('pembelians')->onDelete('cascade');
            $table->foreignId('penjualans_id')->constrained('penjualans')->onDelete('cascade');
            $table->integer('total_quantity');
            //-> total quantity = quantity yang dibeli - quantity yang dijual
            //-> total harga = total quantity * harga
            $table->timestamps();
        });
        // total = quantity * harga
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
