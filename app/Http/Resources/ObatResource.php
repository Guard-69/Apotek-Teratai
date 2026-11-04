<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ObatResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kode_obat' => $this->kode_obat,
            'nama_obat' => $this->nama_obat,
            'stok' => $this->stok,
            'tanggal_kadaluarsa' => $this->tanggal_kadaluarsa?->toDateString(),
            'tanggal_kadaluarsa_format' => $this->tanggal_kadaluarsa_format,
            'status' => $this->status,
            'dibuat_pada' => $this->created_at?->toDateTimeString(),
        ];
    }
}
