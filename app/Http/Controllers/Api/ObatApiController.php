<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ObatRequest;
use App\Http\Resources\ObatResource;
use App\Models\Obat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ObatApiController extends Controller
{
    /** GET /api/obat : daftar + pencarian (q) + pagination */
    public function index(Request $request): AnonymousResourceCollection
    {
        $q = trim((string) $request->query('q', ''));

        $query = Obat::query()->latest('id');

        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('kode_obat', 'like', "%{$q}%")
                  ->orWhere('nama_obat', 'like', "%{$q}%");
            });
        }

        return ObatResource::collection(
            $query->paginate(10)->withQueryString()
        );
    }

    /** GET /api/obat/{id} : detail */
    public function show(Obat $obat): ObatResource
    {
        return new ObatResource($obat);
    }

    /** POST /api/obat : tambah data */
    public function store(ObatRequest $request): JsonResponse
    {
        $item = Obat::create($request->validated());

        return (new ObatResource($item))
            ->additional(['message' => 'Data berhasil disimpan.'])
            ->response()
            ->setStatusCode(201);
    }

    /** PUT/PATCH /api/obat/{id} : ubah data */
    public function update(ObatRequest $request, Obat $obat): JsonResponse
    {
        $obat->update($request->validated());

        return (new ObatResource($obat))
            ->additional(['message' => 'Data berhasil diperbarui.'])
            ->response();
    }

    /** DELETE /api/obat/{id} : hapus data */
    public function destroy(Obat $obat): JsonResponse
    {
        $nama = $obat->nama_obat;
        $obat->delete();

        return response()->json([
            'message' => "Data {$nama} berhasil dihapus.",
        ]);
    }
}
