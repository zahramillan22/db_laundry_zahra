<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::all();
        return view('layanan.index', compact('layanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required',
            'harga_per_kg' => 'required|integer',
            'estimasi_waktu' => 'required',
        ]);
        Layanan::create($request->all());
        return back()->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'nama_layanan' => 'required',
            'harga_per_kg' => 'required|integer',
            'estimasi_waktu' => 'required',
        ]);
        $layanan->update($request->all());
        return back()->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return back()->with('success', 'Layanan berhasil dihapus.');
    }
}