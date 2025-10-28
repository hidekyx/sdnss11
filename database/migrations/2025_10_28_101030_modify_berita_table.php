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
        Schema::table('berita', function (Blueprint $table) {
            $table->string('img_7')->nullable()->after('img_4');
            $table->string('img_6')->nullable()->after('img_4');
            $table->string('img_5')->nullable()->after('img_4');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn('img_5');
            $table->dropColumn('img_6');
            $table->dropColumn('img_7');
        });
    }
};
