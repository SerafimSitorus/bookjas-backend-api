<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'email' => $this->email,
            'foto_profil' => $this->foto_profil,
            'token' => $this->whenNotNull($this->token),
            'status' => 'User'
        ]; 
    }
}
