<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftar_asal_sekolah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftar_id')->constrained('pendaftar_data_siswa')->onDelete('cascade');
            $table->string('npsn', 20);
            $table->string('nama_sekolah', 150);
            $table->string('kabupaten', 100);
            $table->decimal('nilai_rata', 6, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftar_asal_sekolah');
    }
};
