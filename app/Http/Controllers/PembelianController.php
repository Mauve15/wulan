<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Barang;
use App\Models\Pembelian;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data pembelian dari database
        $pembelians = Pembelian::all();  // Kamu bisa sesuaikan query jika perlu

        // Mengirimkan data ke frontend menggunakan Inertia
        return Inertia::render('pembelian', [
            'pembelians' => $pembelians,
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
        $validated = $request->validate([
            'no_invoice' => 'nullable|string',
            'no_faktur' => 'nullable|string',
            'tanggal_pembelian' => 'required|date',
            'nama_barang' => 'required|string',
            'quantity_beli' => 'nullable|integer',
            'harga_satuan' => 'nullable|integer',
            'total_harga_beli' => 'nullable|integer',
            'nama_supplier' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'merk' => 'required|string',
            'status_barang' => 'required|string',
        ]);

        // Simpan data ke pembelian
        $pembelian = Pembelian::create($validated);

        // Simpan data ke barang
        Barang::create([
            'pembelians_id' => $pembelian->id,
            'nama_barang' => $pembelian->nama_barang,
            'quantity_barang' => $pembelian->quantity_beli ?? 0,
            'total_harga' => $pembelian->total_harga_beli ?? 0,
            'penjualans_id' => null,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan ke pembelian dan barang.');
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
