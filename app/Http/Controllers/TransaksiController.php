<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Layanan;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('layanan')->latest()->get();
        $layanans = Layanan::all(); // <-- Pastikan baris ini ada untuk mengambil data layanan
        
        return view('transaksi.index', compact('transaksis', 'layanans')); // <-- Kirim ke view
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'no_hp' => 'required',
            'layanan_id' => 'required',
            'berat_kg' => 'required|numeric|min:1',
        ]);

        $layanan = Layanan::findOrFail($request->layanan_id);
        $totalHarga = $layanan->harga_per_kg * $request->berat_kg;

        Transaksi::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp' => $request->no_hp,
            'layanan_id' => $request->layanan_id,
            'berat_kg' => $request->berat_kg,
            'total_harga' => $totalHarga,
            'status' => 'Proses',
        ]);

        return redirect()->back()->with('success', 'Transaksi berhasil dicatat!');
    }

    public function selesai($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update(['status' => 'Selesai']);
        return redirect()->back()->with('success', 'Status transaksi diubah menjadi Selesai!');
    }
}