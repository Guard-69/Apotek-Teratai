<?php

namespace App\Http\Controllers;

use App\Http\Requests\StafRequest;
use App\Models\Staf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StafController extends Controller
{
    /** Daftar + pencarian + pagination */
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));

        $query = Staf::query()->latest('id');

        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('nama', 'like', "%{$q}%")
                  ->orWhere('alamat', 'like', "%{$q}%")
                  ->orWhere('tempat_lahir', 'like', "%{$q}%")
                  ->orWhere('no_hp', 'like', "%{$q}%");
            });
        }

        $data = $query->paginate(10)->withQueryString();

        return view('staf.index', [
            'data' => $data,
            'q' => $q,
            'stats' => [
                'Total staf' => Staf::count(),
                '7 hari terakhir' => Staf::where('created_at', '>=', now()->subDays(7))->count(),
                $q !== '' ? 'Hasil pencarian' : 'Ditampilkan' => $data->total(),
            ],
        ]);
    }

    /** Formulir tambah data */
    public function create(): View
    {
        return view('staf.create');
    }

    /** Simpan data baru (validasi ada di StafRequest) */
    public function store(StafRequest $request): RedirectResponse
    {
        $item = Staf::create($request->validated());

        return redirect()
            ->route('staf.index')
            ->with('success', "Data {$item->nama} berhasil disimpan.");
    }

    /** Formulir ubah data */
    public function edit(Staf $staf): View
    {
        return view('staf.edit', ['item' => $staf]);
    }

    /** Simpan perubahan */
    public function update(StafRequest $request, Staf $staf): RedirectResponse
    {
        $staf->update($request->validated());

        return redirect()
            ->route('staf.index')
            ->with('success', "Data {$staf->nama} berhasil diperbarui.");
    }

    /** Hapus data */
    public function destroy(Staf $staf): RedirectResponse
    {
        $nama = $staf->nama;
        $staf->delete();

        return redirect()
            ->route('staf.index')
            ->with('success', "Data {$nama} berhasil dihapus.");
    }
}
