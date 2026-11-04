@extends('layouts.app')

@section('title', 'Edit Obat')

@section('content')
    <div class="page-head">
        <div>
            <h1>Edit Obat</h1>
            <p>Ubah data <strong>{{ $item->nama_obat }}</strong>. Kolom bertanda <span class="req">*</span> wajib diisi.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <div class="alert-body">
                <strong>Perubahan belum bisa disimpan.</strong>
                Periksa kembali {{ count($errors->keys()) }} isian yang ditandai merah di bawah.
            </div>
        </div>
    @endif

    <form class="card form-card" method="POST" action="{{ route('obat.update', $item) }}" novalidate data-loading>
        @csrf
        @method('PUT')

        @include('obat._fields')

        <div class="form-actions">
            <button type="submit" class="btn btn-primary"><span class="btn-label">Simpan Perubahan</span></button>
            <a href="{{ route('obat.index') }}" class="btn btn-ghost">Batal</a>
        </div>
    </form>
@endsection
