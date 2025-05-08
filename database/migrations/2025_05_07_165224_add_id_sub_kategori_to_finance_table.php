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
            $table->unsignedBigInteger('id_sub_kategori')->after('id_kategori')->nullable(); // Foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('finance', function (Blueprint $table) {
             $table->dropColumn('id_sub_kategori');
        });
    }
};
