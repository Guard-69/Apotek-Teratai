<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObatRequest;
use App\Models\Obat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ObatController extends Controller
{
    /** Daftar + pencarian + pagination */
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));

        $query = Obat::query()->latest('id');

        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('kode_obat', 'like', "%{$q}%")
                  ->orWhere('nama_obat', 'like', "%{$q}%");
            });
        }

        $data = $query->paginate(10)->withQueryString();

        return view('obat.index', [
            'data' => $data,
            'q' => $q,
            'stats' => [
                'Total jenis obat' => Obat::count(),
                'Sudah kadaluarsa' => Obat::whereDate('tanggal_kadaluarsa', '<', today())->count(),
                'Stok menipis (< 10)' => Obat::where('stok', '<', 10)->count(),
            ],
        ]);
    }

    /** Formulir tambah data */
    public function create(): View
    {
        return view('obat.create');
    }

    /** Simpan data baru (validasi ada di ObatRequest) */
    public function store(ObatRequest $request): RedirectResponse
    {
        $item = Obat::create($request->validated());

        return redirect()
            ->route('obat.index')
            ->with('success', "Data {$item->nama_obat} berhasil disimpan.");
    }

    /** Formulir ubah data */
    public function edit(Obat $obat): View
    {
        return view('obat.edit', ['item' => $obat]);
    }

    /** Simpan perubahan */
    public function update(ObatRequest $request, Obat $obat): RedirectResponse
    {
        $obat->update($request->validated());

        return redirect()
            ->route('obat.index')
            ->with('success', "Data {$obat->nama_obat} berhasil diperbarui.");
    }

    /** Hapus data */
    public function destroy(Obat $obat): RedirectResponse
    {
        $nama = $obat->nama_obat;
        $obat->delete();

        return redirect()
            ->route('obat.index')
            ->with('success', "Data {$nama} berhasil dihapus.");
    }
}
