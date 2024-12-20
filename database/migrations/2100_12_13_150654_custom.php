<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            DROP VIEW IF EXISTS view_peminjaman;
            CREATE VIEW view_peminjaman AS
            SELECT
                a.user_id,
                b.isbn,
                b.sampul,
                b.judul,
                b.penulis,
                c.nama as peminjam,
                a.tanggal_peminjaman,
                a.tanggal_pengembalian,
                a.status,
                a.created_at
            FROM peminjaman a
            INNER JOIN bukus b ON a.isbn = b.isbn
            INNER JOIN users c ON a.user_id = c.id;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
