<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Diskon;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with('diskon')->get();
        return view('penjualans.index', compact('penjualans'));
    }

    public function create()
    {
        $diskons = Diskon::all();
        return view('penjualans.create', compact('diskons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_penjualan' => 'required|unique:penjualans',
            'tanggal_penjualan' => 'required|date',
            'total_harga' => 'required|numeric',
            'diskon_id' => 'nullable|exists:diskons,id',
        ]);

        Penjualan::create($request->all());

        return redirect()->route('penjualans.index')->with('success', 'Penjualan berhasil ditambahkan.');
    }

    public function show(Penjualan $penjualan)
    {
        return view('penjualans.show', compact('penjualan'));
    }

    public function edit(Penjualan $penjualan)
    {
        $diskons = Diskon::all();
        return view('penjualans.edit', compact('penjualan', 'diskons'));
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'kode_penjualan' => 'required|unique:penjualans,kode_penjualan,' . $penjualan->id,
            'tanggal_penjualan' => 'required|date',
            'total_harga' => 'required|numeric',
            'diskon_id' => 'nullable|exists:diskons,id',
        ]);

        $penjualan->update($request->all());

        return redirect()->route('penjualans.index')->with('success', 'Penjualan berhasil diperbarui.');
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();

        return redirect()->route('penjualans.index')->with('success', 'Penjualan berhasil dihapus.');
    }
}
