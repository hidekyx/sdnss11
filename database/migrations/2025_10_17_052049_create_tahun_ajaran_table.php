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
        if(!Schema::hasTable('tahun_ajaran')) {
            Schema::create('tahun_ajaran', function (Blueprint $table) {
                $table->id();
                $table->string('nama')->unique();
                $table->date('tanggal_mulai');
                $table->date('tanggal_selesai');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahun_ajaran');
    }
};
