@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <section class="hero">
        <span class="eyebrow">Sistem Informasi Apotek</span>
        <div class="page-head">
            <div>
                <h1>Apotek Teratai</h1>
                <p>Kelola data pelanggan, staf apotek, dan stok obat. Data juga dapat diakses melalui API (diuji dengan Postman).</p>
            </div>
        </div>
    </section>

    @if ($obatKadaluarsa > 0)
        <div class="alert alert-danger" role="alert">
            <div class="alert-body">
                <strong>Perhatian.</strong>
                Terdapat {{ $obatKadaluarsa }} jenis obat yang sudah melewati tanggal kadaluarsa.
                <a href="{{ route('obat.index') }}">Lihat daftar obat</a>.
            </div>
        </div>
    @endif

    <div class="stats">
        <div class="card stat">
            <div class="stat-label">Pelanggan</div>
            <div class="stat-value">{{ number_format($jumlahPelanggan, 0, ',', '.') }}</div>
            <div class="actions" style="margin-top:12px">
                <a href="{{ route('pelanggan.index') }}" class="btn btn-ghost btn-sm">Lihat Data</a>
                <a href="{{ route('pelanggan.create') }}" class="btn btn-primary btn-sm">+ Tambah</a>
            </div>
        </div>
        <div class="card stat">
            <div class="stat-label">Staf Apotek</div>
            <div class="stat-value">{{ number_format($jumlahStaf, 0, ',', '.') }}</div>
            <div class="actions" style="margin-top:12px">
                <a href="{{ route('staf.index') }}" class="btn btn-ghost btn-sm">Lihat Data</a>
                <a href="{{ route('staf.create') }}" class="btn btn-primary btn-sm">+ Tambah</a>
            </div>
        </div>
        <div class="card stat">
            <div class="stat-label">Jenis Obat</div>
            <div class="stat-value">{{ number_format($jumlahObat, 0, ',', '.') }}</div>
            <div class="actions" style="margin-top:12px">
                <a href="{{ route('obat.index') }}" class="btn btn-ghost btn-sm">Lihat Data</a>
                <a href="{{ route('obat.create') }}" class="btn btn-primary btn-sm">+ Tambah</a>
            </div>
        </div>
    </div>
@endsection
