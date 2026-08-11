<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();

            // Guru yang mengajukan
            $table->foreignId('user_id')
                ->constrained('user')
                ->cascadeOnDelete();

            // Lab yang dipinjam
            $table->foreignId('lab_id')
                ->constrained('lab')
                ->cascadeOnDelete();

            // Mata pelajaran
            $table->foreignId('pelajaran_id')
                ->constrained('pelajaran')
                ->cascadeOnDelete();

            // Keterangan dari guru
            $table->text('keterangan')->nullable();

            // Jadwal peminjaman
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');

            // Status pengajuan
            $table->enum('status', [
                'menunggu',
                'disetujui',
                'ditolak'
            ])->default('menunggu');
            
            $table->text('alasan_penolakan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};