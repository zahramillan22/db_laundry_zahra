@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Jenis Layanan</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">+ Tambah Layanan</button>
</div>

<table class="table table-bordered bg-white">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Nama Layanan</th>
            <th>Harga / Kg</th>
            <th>Estimasi Waktu</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($layanans as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->nama_layanan }}</td>
            <td>Rp {{ number_format($item->harga_per_kg, 0, ',', '.') }}</td>
            <td>{{ $item->estimasi_waktu }}</td>
            <td>
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">Edit</button>
                <form action="{{ route('layanan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus layanan ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>

        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('layanan.update', $item->id) }}" method="POST" class="modal-content">
                    @csrf @method('PUT')
                    <div class="modal-header"><h5 class="modal-title">Edit Layanan</h5></div>
                    <div class="modal-body">
                        <div class="mb-2"><label>Nama Layanan</label><input type="text" name="nama_layanan" value="{{ $item->nama_layanan }}" class="form-control" required></div>
                        <div class="mb-2"><label>Harga / Kg</label><input type="number" name="harga_per_kg" value="{{ $item->harga_per_kg }}" class="form-control" required></div>
                        <div class="mb-2"><label>Estimasi Waktu</label><input type="text" name="estimasi_waktu" value="{{ $item->estimasi_waktu }}" class="form-control" required></div>
                    </div>
                    <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan Perubahan</button></div>
                </form>
            </div>
        </div>
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('layanan.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header"><h5 class="modal-title">Tambah Layanan Baru</h5></div>
            <div class="modal-body">
                <div class="mb-2"><label>Nama Layanan</label><input type="text" name="nama_layanan" class="form-control" required></div>
                <div class="mb-2"><label>Harga / Kg</label><input type="number" name="harga_per_kg" class="form-control" required></div>
                <div class="mb-2"><label>Estimasi Waktu</label><input type="text" name="estimasi_waktu" class="form-control" required></div>
            </div>
            <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
        </form>
    </div>
</div>
@endsection