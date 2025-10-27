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
        if(!Schema::hasTable('ekstrakulikuler')) {
            Schema::create('ekstrakulikuler', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->tinyInteger('kategori');
                $table->unsignedBigInteger('penanggung_jawab_id');
                $table->foreign('penanggung_jawab_id')->references('id')->on('users')->cascadeOnDelete();
                $table->text('deskripsi');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekstrakulikuler');
    }
};
