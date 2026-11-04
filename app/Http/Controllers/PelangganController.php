<?php

namespace App\Http\Controllers;

use App\Http\Requests\PelangganRequest;
use App\Models\Pelanggan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PelangganController extends Controller
{
    /** Daftar + pencarian + pagination */
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));

        $query = Pelanggan::query()->latest('id');

        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('nama', 'like', "%{$q}%")
                  ->orWhere('alamat', 'like', "%{$q}%")
                  ->orWhere('no_hp', 'like', "%{$q}%");
            });
        }

        $data = $query->paginate(10)->withQueryString();

        return view('pelanggan.index', [
            'data' => $data,
            'q' => $q,
            'stats' => [
                'Total pelanggan' => Pelanggan::count(),
                '7 hari terakhir' => Pelanggan::where('created_at', '>=', now()->subDays(7))->count(),
                $q !== '' ? 'Hasil pencarian' : 'Ditampilkan' => $data->total(),
            ],
        ]);
    }

    /** Formulir tambah data */
    public function create(): View
    {
        return view('pelanggan.create');
    }

    /** Simpan data baru (validasi ada di PelangganRequest) */
    public function store(PelangganRequest $request): RedirectResponse
    {
        $item = Pelanggan::create($request->validated());

        return redirect()
            ->route('pelanggan.index')
            ->with('success', "Data {$item->nama} berhasil disimpan.");
    }

    /** Formulir ubah data */
    public function edit(Pelanggan $pelanggan): View
    {
        return view('pelanggan.edit', ['item' => $pelanggan]);
    }

    /** Simpan perubahan */
    public function update(PelangganRequest $request, Pelanggan $pelanggan): RedirectResponse
    {
        $pelanggan->update($request->validated());

        return redirect()
            ->route('pelanggan.index')
            ->with('success', "Data {$pelanggan->nama} berhasil diperbarui.");
    }

    /** Hapus data */
    public function destroy(Pelanggan $pelanggan): RedirectResponse
    {
        $nama = $pelanggan->nama;
        $pelanggan->delete();

        return redirect()
            ->route('pelanggan.index')
            ->with('success', "Data {$nama} berhasil dihapus.");
    }
}
