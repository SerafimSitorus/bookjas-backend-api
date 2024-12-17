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

        return (new KategoriResource($kategori))->response()->setStatusCode(201);

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

        return response()->json([
            'message' => 'Kategori Updated Successfully',
            'data' => new KategoriResource($kategoriData)
        ], 200);
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
        $kategoriData->delete();

        return response()->json([
            'message' => 'Data deleted successfully'
        ], 200);
    }
}
