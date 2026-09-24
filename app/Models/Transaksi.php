<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';

    protected $fillable = [
        'no_tiket',
        'kendaraan_id',
        'area_parkir_id',
        'tarif_parkir_id',
        'petugas_masuk_id',
        'petugas_keluar_id',
        'waktu_masuk',
        'waktu_keluar',
        'total_bayar',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'waktu_masuk' => 'datetime',
            'waktu_keluar' => 'datetime',
        ];
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function areaParkir()
    {
        return $this->belongsTo(AreaParkir::class, 'area_parkir_id');
    }

    public function tarifParkir()
    {
        return $this->belongsTo(TarifParkir::class, 'tarif_parkir_id');
    }

    public function petugasMasuk()
    {
        return $this->belongsTo(User::class, 'petugas_masuk_id');
    }

    public function petugasKeluar()
    {
        return $this->belongsTo(User::class, 'petugas_keluar_id');
    }
}
