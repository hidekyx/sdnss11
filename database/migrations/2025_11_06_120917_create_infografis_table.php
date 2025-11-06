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
        if(!Schema::hasTable('infografis')) {
            Schema::create('infografis', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->tinyInteger('kategori');
                $table->unsignedBigInteger('penanggung_jawab_id');
                $table->foreign('penanggung_jawab_id')->references('id')->on('users')->cascadeOnDelete();
                $table->string('img');
                $table->string('deskripsi_singkat')->nullable();
                $table->tinyInteger('is_published')->default(0);
                $table->datetime('published_at')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infografis');
    }
};
