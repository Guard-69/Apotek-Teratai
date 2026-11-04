@extends('layouts.app')

@section('title', 'Data Staf Apotek')

@section('content')
    <div class="page-head">
        <div>
            <h1>Data Staf Apotek</h1>
            <p>Daftar seluruh staf yang bekerja di apotek.</p>
        </div>
        <a href="{{ route('staf.create') }}" class="btn btn-primary">+ Staf Baru</a>
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
            <form method="GET" action="{{ route('staf.index') }}" role="search">
                <input type="search" name="q" value="{{ $q }}" placeholder="Cari nama, alamat..." aria-label="Cari data">
                <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                @if ($q !== '')
                    <a href="{{ route('staf.index') }}" class="btn btn-ghost btn-sm">Reset</a>
                @endif
            </form>
        </div>

        @if ($data->isEmpty())
            <div class="empty">
                <div class="empty-icon">{{ $q !== '' ? '&#128269;' : '&#128230;' }}</div>
                @if ($q !== '')
                    <h3>Tidak ada hasil</h3>
                    <p>Tidak ditemukan data untuk kata kunci &ldquo;{{ $q }}&rdquo;. Coba kata kunci lain.</p>
                    <a href="{{ route('staf.index') }}" class="btn btn-ghost">Tampilkan semua data</a>
                @else
                    <h3>Belum ada data</h3>
                    <p>Data akan muncul di sini setelah ditambahkan.</p>
                    <a href="{{ route('staf.create') }}" class="btn btn-primary">+ Staf Baru</a>
                @endif
            </div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Tempat, Tgl Lahir</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                            <tr>
                                <td class="num" data-label="ID">{{ $row->kode }}</td>
                                <td data-label="Nama"><div class="person-name">{{ $row->nama }}</div></td>
                                <td data-label="Tempat, Tgl Lahir">{{ $row->tempat_lahir }}, {{ $row->tanggal_lahir_format }}<div class="person-sub">{{ $row->umur }} tahun</div></td>
                                <td data-label="Alamat">{{ $row->alamat }}</td>
                                <td class="num" data-label="No HP">{{ $row->no_hp }}</td>
                                <td class="cell-aksi">
                                    <div class="row-actions">
                                        <a href="{{ route('staf.edit', $row) }}" class="btn btn-ghost btn-sm">Edit</a>
                                        <button type="button" class="btn btn-danger-ghost btn-sm"
                                                data-delete="{{ route('staf.destroy', $row) }}"
                                                data-name="{{ $row->nama }}">Hapus</button>
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
