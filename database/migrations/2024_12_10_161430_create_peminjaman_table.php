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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->foreign('user_id')->on('users')->references('id');
            $table->char('buku_id', 13);
            $table->foreign('buku_id')->on('bukus')->references('isbn');
            $table->timestamp('tanggal_peminjaman');
            $table->timestamp('tanggal_pengembalian')->nullable();
            $table->enum('status', ['dipinjam', 'dikembalikan'])->default('dipinjam');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
