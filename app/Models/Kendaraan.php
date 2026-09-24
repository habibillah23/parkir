<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraans';

    protected $fillable = ['plat_nomor', 'jenis_kendaraan', 'nama_pemilik', 'no_telp'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
