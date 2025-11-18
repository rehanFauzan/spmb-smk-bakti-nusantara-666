<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftar_data_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->dateTime('tanggal_daftar');
            $table->string('no_pendaftaran', 20)->unique();
            $table->foreignId('gelombang_id')->constrained('gelombang');
            $table->foreignId('jurusan_id')->constrained('jurusan');
            $table->enum('status', ['SUBMIT', 'ADM_PASS', 'ADM_REJECT', 'PAID']);
            $table->dateTime('tgl_verifikasi_adm')->nullable();
            $table->dateTime('tgl_verifikasi_payment')->nullable();
            $table->string('nik', 20);
            $table->string('nama', 120);
            $table->string('jk', 1);
            $table->date('tmp_lahir');
            $table->text('alamat');
            $table->foreignId('wilayah_id')->constrained('wilayah');
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftar_data_siswa');
    }
};
