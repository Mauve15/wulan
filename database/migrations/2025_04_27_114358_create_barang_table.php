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
            // $table->string('nama_barang')->nullable(); // Nama barang, bisa diambil dari tabel pembelian atau penjualan
            // $table->integer('harga_barang');
            // $table->integer('total_quantity')->virtualAs('quantity_barang - (select coalesce(sum(quantity), 0) from penjualans where penjualans_id = penjualans.id)');
            $table->integer('total_harga'); //-> ('harga_satuan * quantity_beli');
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
