<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Barang;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('dashboard', [
            'totalQuantityBeli' => Pembelian::sum('quantity_beli'), // Total quantity_beli
            'totalQuantityJual' => Penjualan::sum('quantity_jual'), // Total quantity_jual
            'totalQuantityBarang' => Barang::sum('quantity_barang'), // Total quantity_barang
            'totalHargaPembelian' => Pembelian::sum('total_harga_beli'), // Total total_harga_beli
            'totalHargaJual' => Penjualan::sum('total_harga_jual'),
            'totalNilaiBarang' => Barang::sum('total_harga'),
            'totalSelisih' => Penjualan::sum('total_harga_jual') - Pembelian::sum('total_harga_beli'),
            // 'totalQuantityTersedia' => Barang::where('quantity_barang', '>', 0)->sum('quantity_barang'),
            'totalQuantityBarangA' => Barang::count(),
            'totalBarangTersedia' => Barang::where('quantity_barang', '>', 0)->count(),
            'quantityBarang=' => Barang::sum('quantity_barang') - Penjualan::sum('quantity_jual'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
