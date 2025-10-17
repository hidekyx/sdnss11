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
        if(!Schema::hasTable('berita')) {
            Schema::create('berita', function (Blueprint $table) {
                $table->id();
                $table->text('tags')->nullable();
                $table->tinyInteger('kategori');
                $table->string('title');
                $table->string('slug')->nullable();
                $table->foreignId('writer_id')->nullable()->constrained('users')->cascadeOnDelete();
                $table->text('content');
                $table->string('caption')->nullable();
                $table->string('img')->nullable();
                $table->string('img_2')->nullable();
                $table->string('img_3')->nullable();
                $table->string('img_4')->nullable();
                $table->string('thumbnail')->nullable();
                $table->integer('viewed')->default(0);
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
        Schema::dropIfExists('berita');
    }
};
