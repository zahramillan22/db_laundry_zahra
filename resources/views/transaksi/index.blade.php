@extends('layouts.app')

@section('content')
<div class="card mb-4">
    <div class="card-header bg-white"><strong>Input Transaksi Baru</strong></div>
    <div class="card-body">
        <form action="{{ route('transaksi.store') }}" method="POST" class="row g-3">
            @csrf
            <div class="col-md-3">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label>No. HP</label>
                <input type="text" name="no_hp" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label>Jenis Layanan</label>
                <select name="layanan_id" class="form-select" required>
                    @foreach($layanans as $l)
                        <option value="{{ $l->id }}">{{ $l->nama_layanan }} (Rp {{ number_format($l->harga_per_kg) }}/kg)</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label>Berat (Kg)</label>
                <input type="number" name="berat_kg" class="form-control" min="1" required>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </div>
        </form>
    </div>
</div>

<h4>Rekap Transaksi Laundry</h4>
<table class="table table-bordered bg-white">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>No. HP</th>
            <th>Layanan</th>
            <th>Berat</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaksis as $index => $trx)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $trx->nama_pelanggan }}</td>
            <td>{{ $trx->no_hp }}</td>
            <td>{{ $trx->layanan->nama_layanan }} ({{ $trx->layanan->estimasi_waktu }})</td>
            <td>{{ $trx->berat_kg }} kg</td>
            <td>Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
            <td>
                <span class="badge {{ $trx->status == 'Selesai' ? 'bg-success' : 'bg-warning text-dark' }}">
                    {{ $trx->status }}
                </span>
            </td>
            <td>
                @if($trx->status == 'Proses')
                    <form action="{{ route('transaksi.status', $trx->id) }}" method="POST">
                        @csrf @method('PUT')
                        <button class="btn btn-success btn-sm">Selesaikan</button>
                    </form>
                @else
                    <span class="text-muted">Selesai</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection