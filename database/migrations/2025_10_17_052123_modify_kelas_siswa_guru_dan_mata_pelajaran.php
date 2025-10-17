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
        Schema::table('kelas_siswa', function (Blueprint $table) {
            $table->dropColumn('tahun_ajaran');
            $table->dropColumn('tanggal_mulai');
            $table->dropColumn('tanggal_selesai');
            $table->foreignId('tahun_ajaran_id')->nullable()->constrained('tahun_ajaran')->cascadeOnDelete()->after('siswa_id');
        });

        Schema::table('kelas_guru', function (Blueprint $table) {
            $table->dropColumn('tahun_ajaran');
            $table->dropColumn('tanggal_mulai');
            $table->dropColumn('tanggal_selesai');
            $table->foreignId('tahun_ajaran_id')->nullable()->constrained('tahun_ajaran')->cascadeOnDelete()->after('guru_id');
        });

        Schema::table('mata_pelajaran_guru', function (Blueprint $table) {
            $table->dropColumn('tahun_ajaran');
            $table->foreignId('tahun_ajaran_id')->nullable()->constrained('tahun_ajaran')->cascadeOnDelete()->after('guru_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(!Schema::hasTable('kelas_siswa')) {
            Schema::create('kelas_siswa', function (Blueprint $table) {
                $table->string('tahun_ajaran');
                $table->date('tanggal_mulai')->nullable();
                $table->date('tanggal_selesai')->nullable();
                $table->dropColumn('tahun_ajaran_id');
            });
        }

        if(!Schema::hasTable('kelas_guru')) {
            Schema::create('kelas_guru', function (Blueprint $table) {
                $table->string('tahun_ajaran');
                $table->date('tanggal_mulai')->nullable();
                $table->date('tanggal_selesai')->nullable();
                $table->dropColumn('tahun_ajaran_id');
            });
        }

        if(!Schema::hasTable('mata_pelajaran_guru')) {
            Schema::create('mata_pelajaran_guru', function (Blueprint $table) {
                $table->string('tahun_ajaran');
                $table->dropColumn('tahun_ajaran_id');
            });
        }
    }
};
