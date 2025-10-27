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
        if(!Schema::hasTable('ekstrakulikuler_galeri')) {
            Schema::create('ekstrakulikuler_galeri', function (Blueprint $table) {
                $table->id();
                $table->foreignId('ekstrakulikuler_id')->constrained('ekstrakulikuler')->cascadeOnDelete();
                $table->string('title');
                $table->string('img')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekstrakulikuler_galeri');
    }
};
