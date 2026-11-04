<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/** Aturan validasi dipakai bersama oleh controller web dan controller API */
class ObatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('kode_obat')) {
            $this->merge([
                'kode_obat' => strtoupper(trim((string) $this->input('kode_obat'))),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'kode_obat' => ['required', 'string', 'max:20', Rule::unique('obats', 'kode_obat')->ignore($this->route('obat'))],
            'nama_obat' => ['required', 'string', 'max:150'],
            'stok' => ['required', 'integer', 'min:0', 'max:100000'],
            'tanggal_kadaluarsa' => ['required', 'date', 'after:2000-01-01'],
        ];
    }

    public function attributes(): array
    {
        return [
            'kode_obat' => 'Kode Obat',
            'nama_obat' => 'Nama Obat',
            'stok' => 'Stok Obat',
            'tanggal_kadaluarsa' => 'Tanggal Kadaluarsa / Expired',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute tidak valid.',
            'integer' => ':attribute harus berupa angka bulat.',
            'min.numeric' => ':attribute minimal :min.',
            'max.numeric' => ':attribute maksimal :max.',
            'max.string' => ':attribute maksimal :max karakter.',
            'date' => 'Format :attribute tidak valid.',
            'before' => ':attribute harus sebelum hari ini.',
            'after' => ':attribute tidak valid.',
            'digits_between' => ':attribute harus berupa angka :min sampai :max digit.',
            'unique' => ':attribute ini sudah terdaftar.',
        ];
    }
}
