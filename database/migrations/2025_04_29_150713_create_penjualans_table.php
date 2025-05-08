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
            // $table->string('no_invoice')->unique(); // Invoice unik
            $table->date('tanggal_penjualan');
            $table->integer('quantity_jual'); // Quantity barang yang dijual
            $table->foreignId('diskon_id')->nullable()->constrained('diskons')->nullOnDelete(); // Relasi ke diskon, nullable jika tidak ada diskon
            $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade'); // Relasi ke barang, jika barang dihapus, penjualan juga ikut dihapus
            $table->integer('total_harga_jual')->nullable(); // Total harga setelah diskon
            $table->foreignId('pembelian_id')->nullable()->constrained('pembelians')->onDelete('cascade'); // Relasi ke pembelian, jika pembelian dihapus, penjualan juga ikut dihapus
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
