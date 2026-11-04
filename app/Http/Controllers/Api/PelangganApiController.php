<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PelangganRequest;
use App\Http\Resources\PelangganResource;
use App\Models\Pelanggan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PelangganApiController extends Controller
{
    /** GET /api/pelanggan : daftar + pencarian (q) + pagination */
    public function index(Request $request): AnonymousResourceCollection
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

        return PelangganResource::collection(
            $query->paginate(10)->withQueryString()
        );
    }

    /** GET /api/pelanggan/{id} : detail */
    public function show(Pelanggan $pelanggan): PelangganResource
    {
        return new PelangganResource($pelanggan);
    }

    /** POST /api/pelanggan : tambah data */
    public function store(PelangganRequest $request): JsonResponse
    {
        $item = Pelanggan::create($request->validated());

        return (new PelangganResource($item))
            ->additional(['message' => 'Data berhasil disimpan.'])
            ->response()
            ->setStatusCode(201);
    }

    /** PUT/PATCH /api/pelanggan/{id} : ubah data */
    public function update(PelangganRequest $request, Pelanggan $pelanggan): JsonResponse
    {
        $pelanggan->update($request->validated());

        return (new PelangganResource($pelanggan))
            ->additional(['message' => 'Data berhasil diperbarui.'])
            ->response();
    }

    /** DELETE /api/pelanggan/{id} : hapus data */
    public function destroy(Pelanggan $pelanggan): JsonResponse
    {
        $nama = $pelanggan->nama;
        $pelanggan->delete();

        return response()->json([
            'message' => "Data {$nama} berhasil dihapus.",
        ]);
    }
}
