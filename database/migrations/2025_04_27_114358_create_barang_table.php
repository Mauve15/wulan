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
            $table->foreignId('penjualans_id')->nullable()->constrained('penjualans')->onDelete('cascade')->change();
            $table->integer('quantity_barang');

            $table->integer('total_harga'); //-> ('harga_satuan * quantity_beli');
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
