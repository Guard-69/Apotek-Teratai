@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
    <div class="page-head">
        <div>
            <h1>Edit Pelanggan</h1>
            <p>Ubah data <strong>{{ $item->nama }}</strong>. Kolom bertanda <span class="req">*</span> wajib diisi.</p>
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

    <form class="card form-card" method="POST" action="{{ route('pelanggan.update', $item) }}" novalidate data-loading>
        @csrf
        @method('PUT')

        @include('pelanggan._fields')

        <div class="form-actions">
            <button type="submit" class="btn btn-primary"><span class="btn-label">Simpan Perubahan</span></button>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-ghost">Batal</a>
        </div>
    </form>
@endsection
