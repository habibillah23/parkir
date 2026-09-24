<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TarifParkir extends Model
{
    protected $table = 'tarif_parkirs';

    protected $fillable = [
        'jenis_kendaraan',
        'tarif_jam_pertama',
        'tarif_jam_berikutnya',
        'tarif_maksimal_harian',
    ];

    /**
     * Hitung total biaya parkir berdasarkan durasi dalam menit.
     */
    public function hitungBiaya(int $durasiMenit): int
    {
        $jamPertama = 60;

        if ($durasiMenit <= $jamPertama) {
            $total = $this->tarif_jam_pertama;
        } else {
            $sisaMenit = $durasiMenit - $jamPertama;
            $jamBerikutnya = (int) ceil($sisaMenit / 60);
            $total = $this->tarif_jam_pertama + ($jamBerikutnya * $this->tarif_jam_berikutnya);
        }

        if ($this->tarif_maksimal_harian && $total > $this->tarif_maksimal_harian) {
            $hari = max(1, (int) ceil($durasiMenit / 1440));
            $total = min($total, $this->tarif_maksimal_harian * $hari);
        }

        return (int) $total;
    }
}
