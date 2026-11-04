<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggans';

    protected $fillable = ['nama', 'alamat', 'no_hp'];

    /** ID tampilan yang diturunkan dari id, contoh: PL-0007 */
    protected function kode(): Attribute
    {
        return Attribute::get(fn () => 'PL-' . str_pad((string) $this->id, 4, '0', STR_PAD_LEFT));
    }
}
