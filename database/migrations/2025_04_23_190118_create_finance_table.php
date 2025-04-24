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
        Schema::create('finance', function (Blueprint $table) {
            $table->id();
            $table->datetime('tgl_proses');
            $table->unsignedBigInteger('id_pencatat'); // Foreign key
            $table->integer('jumlah_rupiah');
            $table->string('kategori');
            $table->string('sub_kategori');
            $table->text('detail')->nullable();
            $table->timestamps();

            $table->foreign('id_pencatat')
                ->references('id')->on('users')
                ->onDelete('restrict'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance');
    }
};
