<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lab', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lab');
            $table->integer('kapasitas_murid');
            $table->enum('status', [
        'tersedia',
        'tidak_tersedia',
        "sedang_maintenance"
    ])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lab');
    }
};