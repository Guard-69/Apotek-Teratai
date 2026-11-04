@extends('layouts.app')

@section('title', 'Daftar Obat')

@section('content')
    <div class="page-head">
        <div>
            <h1>Daftar Obat</h1>
            <p>Daftar obat beserta stok dan tanggal kadaluarsanya.</p>
        </div>
        <a href="{{ route('obat.create') }}" class="btn btn-primary">+ Obat Baru</a>
    </div>

    <div class="stats">
        @foreach ($stats as $label => $nilai)
            <div class="card stat">
                <div class="stat-label">{{ $label }}</div>
                <div class="stat-value">{{ number_format($nilai, 0, ',', '.') }}</div>
            </div>
        @endforeach
    </div>

    <div class="card">
        <div class="toolbar">
            <form method="GET" action="{{ route('obat.index') }}" role="search">
                <input type="search" name="q" value="{{ $q }}" placeholder="Cari kode obat, nama obat..." aria-label="Cari data">
                <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                @if ($q !== '')
                    <a href="{{ route('obat.index') }}" class="btn btn-ghost btn-sm">Reset</a>
                @endif
            </form>
        </div>

        @if ($data->isEmpty())
            <div class="empty">
                <div class="empty-icon">{{ $q !== '' ? '&#128269;' : '&#128230;' }}</div>
                @if ($q !== '')
                    <h3>Tidak ada hasil</h3>
                    <p>Tidak ditemukan data untuk kata kunci &ldquo;{{ $q }}&rdquo;. Coba kata kunci lain.</p>
                    <a href="{{ route('obat.index') }}" class="btn btn-ghost">Tampilkan semua data</a>
                @else
                    <h3>Belum ada data</h3>
                    <p>Data akan muncul di sini setelah ditambahkan.</p>
                    <a href="{{ route('obat.create') }}" class="btn btn-primary">+ Obat Baru</a>
                @endif
            </div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                        <th>Kode</th>
                        <th>Nama Obat</th>
                        <th>Stok</th>
                        <th>Kadaluarsa</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                            <tr>
                                <td class="num" data-label="Kode">{{ $row->kode_obat }}</td>
                                <td data-label="Nama Obat"><div class="person-name">{{ $row->nama_obat }}</div></td>
                                <td class="num" data-label="Stok">{{ $row->stok }}@if ($row->stok < 10) <span class="badge badge-warn">Menipis</span>@endif</td>
                                <td data-label="Kadaluarsa">{{ $row->tanggal_kadaluarsa_format }} <span class="badge {{ $row->status_class }}">{{ $row->status }}</span></td>
                                <td class="cell-aksi">
                                    <div class="row-actions">
                                        <a href="{{ route('obat.edit', $row) }}" class="btn btn-ghost btn-sm">Edit</a>
                                        <button type="button" class="btn btn-danger-ghost btn-sm"
                                                data-delete="{{ route('obat.destroy', $row) }}"
                                                data-name="{{ $row->nama_obat }}">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="table-foot">
                <span>Menampilkan {{ $data->firstItem() }}&ndash;{{ $data->lastItem() }} dari {{ $data->total() }} data</span>
                {{ $data->links() }}
            </div>
        @endif
    </div>

    @include('partials.delete-dialog')
@endsection
