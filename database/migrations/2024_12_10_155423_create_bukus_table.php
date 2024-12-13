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
        Schema::create('bukus', function (Blueprint $table) {
            $table->char('isbn', 13);
            $table->string('sampul', 255);
            $table->string('judul', 500);
            $table->string('kategori', 500);
            $table->foreign('kategori')->on('kategoris')->references('kategori');
            $table->string('penulis', 255);
            $table->string('penerbit', 255);
            $table->text('deskripsi');
            $table->char('tahun_terbit', 4);
            $table->unsignedInteger('jumlah_tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
