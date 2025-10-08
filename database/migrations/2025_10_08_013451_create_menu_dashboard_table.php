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
        if(!Schema::hasTable('menu_dashboard')) {
            Schema::create('menu_dashboard', function (Blueprint $table) {
                $table->id();
                $table->foreignId('parent_id')->nullable()->constrained('menu')->cascadeOnDelete();
                $table->string('name');
                $table->string('icon')->nullable();
                $table->string('route')->nullable();
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
        Schema::dropIfExists('menu_dashboard');
    }
};
