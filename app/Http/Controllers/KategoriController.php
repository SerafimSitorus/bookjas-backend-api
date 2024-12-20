<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriCreateRequest;
use App\Http\Resources\KategoriResource;
use App\Models\Kategori;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function list() : JsonResponse{
        $data = Kategori::all();

        return (KategoriResource::collection($data))->response()->setStatusCode(200);
    }

    public function get(string $kategori) : JsonResponse{
        $data = Kategori::where('kategori', $kategori)->first();

        return response()->json([
            'data' => [
                'kategori' => $data['kategori']
            ]
        ], 200);;
    }

    public function create(KategoriCreateRequest $request) : JsonResponse {
        $user = Auth::user();
        
        if (!$user->status == 'Admin') {
            throw new HttpResponseException(response([
                'errors' => [
                    'message' => ["Not Allowed"]
                ]
            ], 403));
        }

        $data = $request->validated();

        $kategori = new Kategori($data);
        $kategori->save();

        return response()->json(['message' => 'Kategori berhasil ditambahkan']);
    }

    public function update(string $kategori, KategoriCreateRequest $request) : JsonResponse {
        $user = Auth::user();
        
        if (!$user->status == 'Admin') {
            throw new HttpResponseException(response([
                'errors' => [
                    'message' => ["Not Allowed"]
                ]
            ], 403));
        }
        
        $data = $request->validated();
        $kategoriData = Kategori::where('kategori', $kategori)->first();

        $kategoriData->fill($data);
        $kategoriData->save();

        return response()->json(['message' => 'Kategori berhasil diubah'], 200);
    }

    public function delete(string $kategori) : JsonResponse {
        $user = Auth::user();
        
        if (!$user->status == 'Admin') {
            throw new HttpResponseException(response([
                'errors' => [
                    'message' => ["Not Allowed"]
                ]
            ], 403));
        }

        $kategoriData = Kategori::where('kategori', $kategori)->first();

        try {
            $kategoriData->delete();
        } catch (\Throwable $th) {
            return response()->json(['errors' => 'Kategori sedang digunakan di buku lain'], 400);
        }

        return response()->json([
            'message' => 'Kategori berhasil dihapus'
        ], 200);
    }
}
