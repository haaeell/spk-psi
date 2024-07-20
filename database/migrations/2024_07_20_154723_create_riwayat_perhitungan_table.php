<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayat_perhitungan', function (Blueprint $table) {
            $table->id();
            $table->integer('peringkat');
            $table->string('kode_siswa');
            $table->string('nama_siswa');
            $table->decimal('nilai_akhir', 15, 9);
            $table->year('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_perhitungan');
    }
};
