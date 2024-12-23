<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BukuUpdateRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return ($this->user() != null && $this->user()->status == 'Admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            "sampul" => ['required'],
            "judul" => ['required', 'string', 'max:500'],
            "kategori" => ['required', 'string', 'max:255'],
            "penulis" => ['required', 'string', 'max:255'],
            "penerbit" => ['required', 'string', 'max:255'],
            "deskripsi" => ['required', 'string'],       
            "tahun_terbit" => ['required', 'string', 'max:24'],
            "jumlah_tersedia" => ['required', 'integer']
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response([
            'errors' => $validator->getMessageBag()
        ], 400)); 
    }
}