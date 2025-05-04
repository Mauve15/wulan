<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    public function index()
    {
        $diskons = Diskon::all();
        return view('diskons.index', compact('diskons'));
    }

    public function create()
    {
        return view('diskons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_diskon' => 'required|unique:diskons',
            'nama_diskon' => 'required|string|max:255',
            'jumlah_diskon' => 'required|string|max:255',
            'satuan_diskon' => 'required|string|max:255',
        ]);

        Diskon::create($request->all());

        return redirect()->route('diskons.index')->with('success', 'Diskon berhasil ditambahkan.');
    }

    public function show(Diskon $diskon)
    {
        return view('diskons.show', compact('diskon'));
    }

    public function edit(Diskon $diskon)
    {
        return view('diskons.edit', compact('diskon'));
    }

    public function update(Request $request, Diskon $diskon)
    {
        $request->validate([
            'nama_diskon' => 'required|string|max:255',
            'jumlah_diskon' => 'required|string|max:255',
            'satuan_diskon' => 'required|string|max:255',
        ]);

        $diskon->update($request->all());

        return redirect()->route('diskons.index')->with('success', 'Diskon berhasil diperbarui.');
    }

    public function destroy(Diskon $diskon)
    {
        $diskon->delete();

        return redirect()->route('diskons.index')->with('success', 'Diskon berhasil dihapus.');
    }
}
