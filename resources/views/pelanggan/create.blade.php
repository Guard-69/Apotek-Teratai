@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
    <section class="hero">
        <span class="eyebrow">Pelanggan</span>
        <div class="page-head">
            <div>
                <h1>Formulir Pelanggan</h1>
                <p>Lengkapi data berikut dengan benar. Kolom bertanda <span class="req">*</span> wajib diisi.</p>
            </div>
        </div>
    </section>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <div class="alert-body">
                <strong>Data belum bisa disimpan.</strong>
                Periksa kembali {{ count($errors->keys()) }} isian yang ditandai merah di bawah.
            </div>
        </div>
    @endif

    <form class="card form-card" method="POST" action="{{ route('pelanggan.store') }}" novalidate data-loading>
        @csrf

        @include('pelanggan._fields')

        <div class="form-actions">
            <button type="submit" class="btn btn-primary"><span class="btn-label">Simpan</span></button>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-ghost">Batal</a>
        </div>
    </form>
@endsection
