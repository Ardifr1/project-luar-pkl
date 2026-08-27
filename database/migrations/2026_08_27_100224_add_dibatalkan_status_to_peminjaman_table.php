<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE peminjaman
            MODIFY status ENUM(
                'menunggu',
                'disetujui',
                'ditolak',
                'dibatalkan'
            ) NOT NULL DEFAULT 'menunggu'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE peminjaman
            MODIFY status ENUM(
                'menunggu',
                'disetujui',
                'ditolak'
            ) NOT NULL DEFAULT 'menunggu'
        ");
    }
};