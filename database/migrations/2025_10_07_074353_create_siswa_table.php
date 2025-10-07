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
        if(!Schema::hasTable('siswa')) {
            Schema::create('siswa', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('nipd', 4)->unique();
                $table->string('nisn', 10)->unique();
                $table->string('nik', 20)->unique();
                $table->enum('jenis_kelamin', ['L', 'P']);
                $table->string('tempat_lahir')->nullable();
                $table->date('tanggal_lahir')->nullable();
                $table->string('avatar')->nullable();
                $table->string('no_hp')->nullable();
                $table->string('agama')->nullable();
                $table->string('alamat_detail')->nullable();
                $table->string('alamat_rt')->nullable();
                $table->string('alamat_rw')->nullable();
                $table->string('alamat_dusun')->nullable();
                $table->string('alamat_kelurahan')->nullable();
                $table->string('alamat_kecamatan')->nullable();
                $table->string('alamat_kode_pos')->nullable();
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
        Schema::dropIfExists('siswa');
    }
};
