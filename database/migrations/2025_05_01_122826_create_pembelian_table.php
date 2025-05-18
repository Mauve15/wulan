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
            $table->string('no_invoice')->nullable();
            $table->string('no_faktur')->nullable();
            $table->date('tanggal_pembelian');
            $table->string('nama_barang');
            $table->integer('quantity_beli')->nullable(); //masuk ke total quantity barang
            $table->integer('harga_satuan')->nullable();
            $table->integer('total_harga_beli')->nullable();
            $table->string('nama_supplier')->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('merk');
            // $table->string('status_barang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};
