<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Barang;
use Illuminate\Http\Request;

class DetailPenjualanController extends Controller
{
    public function index()
    {
        $detailPenjualans = DetailPenjualan::with(['penjualan', 'barang'])->get();
        return view('detailpenjualans.index', compact('detailPenjualans'));
    }

    public function create()
    {
        $penjualans = Penjualan::all();
        $barangs = Barang::all();
        return view('detailpenjualans.create', compact('penjualans', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:penjualans,id',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah_beli' => 'required|numeric',
            'total_harga' => 'required|numeric',
        ]);

        DetailPenjualan::create($request->all());

        return redirect()->route('detailpenjualans.index')->with('success', 'Detail penjualan berhasil ditambahkan.');
    }

    public function show(DetailPenjualan $detailPenjualan)
    {
        return view('detailpenjualans.show', compact('detailPenjualan'));
    }

    public function edit(DetailPenjualan $detailPenjualan)
    {
        $penjualans = Penjualan::all();
        $barangs = Barang::all();
        return view('detailpenjualans.edit', compact('detailPenjualan', 'penjualans', 'barangs'));
    }

    public function update(Request $request, DetailPenjualan $detailPenjualan)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:penjualans,id',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah_beli' => 'required|numeric',
            'total_harga' => 'required|numeric',
        ]);

        $detailPenjualan->update($request->all());

        return redirect()->route('detailpenjualans.index')->with('success', 'Detail penjualan berhasil diperbarui.');
    }

    public function destroy(DetailPenjualan $detailPenjualan)
    {
        $detailPenjualan->delete();

        return redirect()->route('detailpenjualans.index')->with('success', 'Detail penjualan berhasil dihapus.');
    }
}
