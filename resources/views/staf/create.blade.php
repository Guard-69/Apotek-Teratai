@extends('layouts.app')

@section('title', 'Tambah Staf Apotek')

@section('content')
    <section class="hero">
        <span class="eyebrow">Staf Apotek</span>
        <div class="page-head">
            <div>
                <h1>Formulir Staf Apotek</h1>
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

    <form class="card form-card" method="POST" action="{{ route('staf.store') }}" novalidate data-loading>
        @csrf

        @include('staf._fields')

        <div class="form-actions">
            <button type="submit" class="btn btn-primary"><span class="btn-label">Simpan</span></button>
            <a href="{{ route('staf.index') }}" class="btn btn-ghost">Batal</a>
        </div>
    </form>
@endsection
