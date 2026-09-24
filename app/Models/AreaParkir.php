<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaParkir extends Model
{
    protected $table = 'area_parkirs';

    protected $fillable = ['nama_area', 'lokasi', 'kapasitas', 'status'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'area_parkir_id');
    }

    public function kapasitasTerpakai(): int
    {
        return $this->transaksis()->where('status', 'masuk')->count();
    }
}
