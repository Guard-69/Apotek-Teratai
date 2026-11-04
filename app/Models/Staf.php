<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staf extends Model
{
    use HasFactory;

    protected $table = 'stafs';

    protected $fillable = ['nama', 'alamat', 'tanggal_lahir', 'tempat_lahir', 'no_hp'];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    /** ID tampilan yang diturunkan dari id, contoh: ST-0003 */
    protected function kode(): Attribute
    {
        return Attribute::get(fn () => 'ST-' . str_pad((string) $this->id, 4, '0', STR_PAD_LEFT));
    }

    /** Contoh: 17 April 1995 */
    protected function tanggalLahirFormat(): Attribute
    {
        return Attribute::get(fn () => $this->tanggal_lahir?->translatedFormat('d F Y'));
    }

    protected function umur(): Attribute
    {
        return Attribute::get(fn () => $this->tanggal_lahir?->age);
    }
}
