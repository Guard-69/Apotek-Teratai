@extends('layouts.app')

@section('title', 'Halaman tidak ditemukan')

@section('content')
    <div class="card notfound">
        <div class="code">404</div>
        <h1>Halaman tidak ditemukan</h1>
        <p class="hint">Alamat yang Anda buka tidak tersedia atau data sudah tidak ada.</p>
        <div class="actions" style="margin-top:12px">
            <a href="{{ route('beranda') }}" class="btn btn-primary">Ke Beranda</a>
            <a href="{{ route('obat.index') }}" class="btn btn-ghost">Daftar Obat</a>
        </div>
    </div>
@endsection
