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
        if(!Schema::hasTable('mata_pelajaran_guru')) {
            Schema::create('mata_pelajaran_guru', function (Blueprint $table) {
                $table->id();
                $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajaran')->cascadeOnDelete();
                $table->foreignId('guru_id')->constrained('users')->cascadeOnDelete();
                $table->string('tahun_ajaran');
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
        Schema::dropIfExists('mata_pelajaran_guru');
    }
};
