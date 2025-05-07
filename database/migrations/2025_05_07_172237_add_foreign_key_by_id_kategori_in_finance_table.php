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
        Schema::table('finance', function (Blueprint $table) {
            $table->foreign('id_kategori')
                ->references('id')->on('kategori')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('finance', function (Blueprint $table) {
            $table->dropForeign(['id_kategori']);
        });
    }
};
