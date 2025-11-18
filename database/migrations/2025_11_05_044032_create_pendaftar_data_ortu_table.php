<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftar_data_ortu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftar_id')->constrained('pendaftar_data_siswa')->onDelete('cascade');
            $table->string('nama_ayah', 120);
            $table->string('pekerjaan_ayah', 100);
            $table->string('no_ayah', 20);
            $table->string('nama_ibu', 120);
            $table->string('pekerjaan_ibu', 100);
            $table->string('no_ibu', 20);
            $table->string('nama_wali', 120)->nullable();
            $table->string('pekerjaan_wali', 100)->nullable();
            $table->string('no_wali', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftar_data_ortu');
    }
};
