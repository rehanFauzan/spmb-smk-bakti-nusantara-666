<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftar_data_siswa', function (Blueprint $table) {
            $table->enum('status_berkas', ['PENDING', 'APPROVED', 'REJECTED'])->default('PENDING')->after('status');
            $table->enum('status_pembayaran', ['PENDING', 'APPROVED', 'REJECTED'])->default('PENDING')->after('status_berkas');
        });
    }

    public function down(): void
    {
        Schema::table('pendaftar_data_siswa', function (Blueprint $table) {
            $table->dropColumn(['status_berkas', 'status_pembayaran']);
        });
    }
};