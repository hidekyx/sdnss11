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
        if(!Schema::hasTable('ekstrakulikuler_siswa')) {
            Schema::create('ekstrakulikuler_siswa', function (Blueprint $table) {
                $table->id();
                $table->foreignId('ekstrakulikuler_id')->constrained('ekstrakulikuler')->cascadeOnDelete();
                $table->foreignId('siswa_id')->constrained('siswa')->cascadeOnDelete();
                $table->foreignId('tahun_ajaran_id')->nullable()->constrained('tahun_ajaran')->cascadeOnDelete();
                $table->enum('status', ['Aktif', 'Selesai'])->default('aktif');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekstrakulikuler_siswa');
    }
};
