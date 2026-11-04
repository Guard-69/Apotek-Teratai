<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** Aturan validasi dipakai bersama oleh controller web dan controller API */
class PelangganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('no_hp')) {
            $this->merge([
                'no_hp' => preg_replace('/\D/', '', (string) $this->input('no_hp')),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:100'],
            'alamat' => ['required', 'string', 'max:500'],
            'no_hp' => ['required', 'digits_between:10,15'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'no_hp' => 'No HP',
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
