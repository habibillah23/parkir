<?php

namespace Database\Seeders;

use App\Models\AreaParkir;
use App\Models\TarifParkir;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@parkir.test'], [
            'name' => 'Administrator',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::updateOrCreate(['email' => 'petugas@parkir.test'], [
            'name' => 'Petugas Parkir',
            'password' => Hash::make('password'),
            'role' => 'petugas',
        ]);

        User::updateOrCreate(['email' => 'owner@parkir.test'], [
            'name' => 'Owner',
            'password' => Hash::make('password'),
            'role' => 'owner',
        ]);

        AreaParkir::updateOrCreate(['nama_area' => 'Area A'], [
            'lokasi' => 'Depan Gedung Utama',
            'kapasitas' => 50,
            'status' => 'aktif',
        ]);

        TarifParkir::updateOrCreate(['jenis_kendaraan' => 'motor'], [
            'tarif_jam_pertama' => 2000,
            'tarif_jam_berikutnya' => 1000,
            'tarif_maksimal_harian' => 15000,
        ]);

        TarifParkir::updateOrCreate(['jenis_kendaraan' => 'mobil'], [
            'tarif_jam_pertama' => 5000,
            'tarif_jam_berikutnya' => 2000,
            'tarif_maksimal_harian' => 40000,
        ]);
    }
}
