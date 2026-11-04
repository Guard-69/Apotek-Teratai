<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obats';

    protected $fillable = ['kode_obat', 'nama_obat', 'stok', 'tanggal_kadaluarsa'];

    protected function casts(): array
    {
        return [
            'tanggal_kadaluarsa' => 'date',
            'stok' => 'integer',
        ];
    }

    /** Contoh: 31 Desember 2028 */
    protected function tanggalKadaluarsaFormat(): Attribute
    {
        return Attribute::get(fn () => $this->tanggal_kadaluarsa?->translatedFormat('d F Y'));
    }

    /** Kadaluarsa / Segera kadaluarsa (30 hari) / Aman */
    protected function status(): Attribute
    {
        return Attribute::get(function () {
            $tanggal = $this->tanggal_kadaluarsa;

            if ($tanggal === null) {
                return 'Tidak diketahui';
            }
            if ($tanggal->lt(today())) {
                return 'Kadaluarsa';
            }
            if ($tanggal->lte(today()->addDays(30))) {
                return 'Segera kadaluarsa';
            }

            return 'Aman';
        });
    }

    /** Nama kelas CSS untuk badge status */
    protected function statusClass(): Attribute
    {
        return Attribute::get(fn () => match ($this->status) {
            'Kadaluarsa' => 'badge-danger',
            'Segera kadaluarsa' => 'badge-warn',
            default => 'badge-ok',
        });
    }
}
