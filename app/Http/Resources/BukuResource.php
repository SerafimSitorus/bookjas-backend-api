<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BukuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'isbn' => $this->isbn,
          'sampul' => $this->sampul,
          'judul' => $this->judul,
          'kategori' => $this->kategori,
          'penulis' => $this->penulis,
          'penerbit' => $this->penerbit,        
          'deskripsi' => $this->deskripsi,
          'tahun_terbit' => $this->tahun_terbit,
          'jumlah_tersedia' => $this->jumlah_tersedia
        ];
    }
}
