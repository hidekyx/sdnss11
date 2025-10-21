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
        if(!Schema::hasTable('agenda')) {
            Schema::create('agenda', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('penanggung_jawab_id');
                $table->foreign('penanggung_jawab_id')->references('id')->on('users')->cascadeOnDelete();
                $table->date('date');
                $table->string('time');
                $table->string('title', 500);
                $table->string('location');
                $table->tinyInteger('is_published')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda');
    }
};
