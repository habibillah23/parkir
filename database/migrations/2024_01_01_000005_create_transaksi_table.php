<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('no_tiket')->unique();
            $table->foreignId('kendaraan_id')->constrained('kendaraans');
            $table->foreignId('area_parkir_id')->constrained('area_parkirs');
            $table->foreignId('tarif_parkir_id')->constrained('tarif_parkirs');
            $table->foreignId('petugas_masuk_id')->constrained('users');
            $table->foreignId('petugas_keluar_id')->nullable()->constrained('users');
            $table->dateTime('waktu_masuk');
            $table->dateTime('waktu_keluar')->nullable();
            $table->unsignedBigInteger('total_bayar')->nullable();
            $table->enum('status', ['masuk', 'selesai'])->default('masuk');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
