<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class   BukuUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return ($this->user() != null && $this->user()->status == 'Admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "sampul" => ['image', 'max:255'],
            "judul" => ['string', 'max:500'],
            "kategori" => ['string', 'max:255'],
            "penulis" => ['string', 'max:255'],
            "penerbit" => ['string', 'max:255'],
            "deskripsi" => ['string'],       
            "tahun_terbit" => ['string', 'max:4'],
            "jumlah_tersedia" => ['integer']
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response([
            'errors' => $validator->getMessageBag()
        ], 400)); 
        
    }
}
