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
        Schema::table('pendaftar', function (Blueprint $table) {
            $table->string('asal_sekolah')->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->decimal('nominal_bayar', 10, 2)->nullable();
            $table->enum('status_pembayaran', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->enum('status_berkas', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->text('catatan_pembayaran')->nullable();
            $table->text('catatan_berkas')->nullable();
            $table->timestamp('verifikasi_pembayaran_at')->nullable();
            $table->timestamp('verifikasi_berkas_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftar', function (Blueprint $table) {
            $table->dropColumn([
                'asal_sekolah', 'bukti_bayar', 'nominal_bayar',
                'status_pembayaran', 'status_berkas', 'catatan_pembayaran', 
                'catatan_berkas', 'verifikasi_pembayaran_at', 'verifikasi_berkas_at'
            ]);
        });
    }
};
