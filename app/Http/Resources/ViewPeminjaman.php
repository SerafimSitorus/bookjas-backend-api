<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ViewPeminjaman extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'isbn' => $this->isbn,
            'sampul' => $this->sampul,
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'peminjam' => $this->peminjam,
            'tanggal_peminjaman' => $this->tanggal_peminjaman,
            'tanggal_pengembalian' => $this->tanggal_pengembalian,
            'status' => $this->status,
            'hari_tersisa' => $this->hari_tersisa,
            'tenggat' => $this->tenggat
        ];
    }
}
