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
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pembelian')->unique();
            $table->string('kode_barang')->unique();
            $table->date('tanggal_pembelian');
            $table->string('nama_barang');
            $table->integer('quantity'); //masuk ke total quantity barang
            $table->integer('harga_satuan');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('merk');
            $table->string('status_barang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian');
    }
};
