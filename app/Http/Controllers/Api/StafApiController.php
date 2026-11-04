<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StafRequest;
use App\Http\Resources\StafResource;
use App\Models\Staf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StafApiController extends Controller
{
    /** GET /api/staf : daftar + pencarian (q) + pagination */
    public function index(Request $request): AnonymousResourceCollection
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

        return StafResource::collection(
            $query->paginate(10)->withQueryString()
        );
    }

    /** GET /api/staf/{id} : detail */
    public function show(Staf $staf): StafResource
    {
        return new StafResource($staf);
    }

    /** POST /api/staf : tambah data */
    public function store(StafRequest $request): JsonResponse
    {
        $item = Staf::create($request->validated());

        return (new StafResource($item))
            ->additional(['message' => 'Data berhasil disimpan.'])
            ->response()
            ->setStatusCode(201);
    }

    /** PUT/PATCH /api/staf/{id} : ubah data */
    public function update(StafRequest $request, Staf $staf): JsonResponse
    {
        $staf->update($request->validated());

        return (new StafResource($staf))
            ->additional(['message' => 'Data berhasil diperbarui.'])
            ->response();
    }

    /** DELETE /api/staf/{id} : hapus data */
    public function destroy(Staf $staf): JsonResponse
    {
        $nama = $staf->nama;
        $staf->delete();

        return response()->json([
            'message' => "Data {$nama} berhasil dihapus.",
        ]);
    }
}
