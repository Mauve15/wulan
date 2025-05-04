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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('no_invoice')->unique();
            $table->date('tanggal_penjualan');
            $table->integer('quantity'); //ambil dari total quantity barang
            $table->foreignId('diskon_id')->nullable()->constrained('diskons')->nullOnDelete();
            $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade');
            $table->integer('total_harga'); //->total harga = 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
