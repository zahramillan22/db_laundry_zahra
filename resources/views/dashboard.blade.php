@extends('layouts.app')

@section('content')
<h3>Dashboard Utama</h3>
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card text-bg-primary mb-3">
            <div class="card-body">
                <h5>Total Transaksi</h5>
                <h2>{{ $totalTransaksi }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-warning mb-3">
            <div class="card-body">
                <h5>Sedang Proses</h5>
                <h2>{{ $transaksiProses }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-success mb-3">
            <div class="card-body">
                <h5>Total Pendapatan</h5>
                <h2>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-info mb-3">
            <div class="card-body">
                <h5>Jenis Layanan</h5>
                <h2>{{ $jumlahLayanan }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection