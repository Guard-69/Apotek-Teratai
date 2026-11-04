<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StafResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kode' => $this->kode,
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'tanggal_lahir' => $this->tanggal_lahir?->toDateString(),
            'tanggal_lahir_format' => $this->tanggal_lahir_format,
            'umur' => $this->umur,
            'tempat_lahir' => $this->tempat_lahir,
            'no_hp' => $this->no_hp,
            'dibuat_pada' => $this->created_at?->toDateTimeString(),
        ];
    }
}
