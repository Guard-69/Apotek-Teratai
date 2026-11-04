@extends('layouts.app')

@section('title', 'Tambah Obat')

@section('content')
    <section class="hero">
        <span class="eyebrow">Obat</span>
        <div class="page-head">
            <div>
                <h1>Formulir Obat</h1>
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

    <form class="card form-card" method="POST" action="{{ route('obat.store') }}" novalidate data-loading>
        @csrf

        @include('obat._fields')

        <div class="form-actions">
            <button type="submit" class="btn btn-primary"><span class="btn-label">Simpan</span></button>
            <a href="{{ route('obat.index') }}" class="btn btn-ghost">Batal</a>
        </div>
    </form>
@endsection
