<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\BukuResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\BukuCollection;
use App\Http\Requests\BukuCreateRequest;
use App\Http\Requests\BukuUpdateRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Exceptions\HttpResponseException;

class BukuController extends Controller
{
    private function getBuku(User $user, string $isbn, $process): Buku
    {
        $buku = Buku::where('isbn', $isbn)->first();
        if (!($process == 'get')) {
            if ($user->status != 'Admin') {
                throw new HttpResponseException(response([
                    'errors' => [
                        'message' => ["Unauthorized"]
                    ]
                ], 401));
            }
        }

        if (!$buku) {
            throw new HttpResponseException(response()->json(
                [
                    'errors' => [
                        'message' => ["Buku not found"]
                    ]
                ]
            )->setStatusCode(404));
        }
        
        return $buku;
    }

    public function create(BukuCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = Auth::user();
        if ($user->status != 'Admin') {
            throw new HttpResponseException(response([
                'errors' => [
                    'message' => ["Unauthorized"]
                ]
            ], 401));
        }
        $buku = new Buku($data);
        $buku->save();

        return (new BukuResource($buku))->response()->setStatusCode(201);
    }

    public function get(string $isbn): BukuResource
    {
        $user = Auth::user();
        $buku = $this->getBuku($user, $isbn, 'get');

        return new BukuResource($buku);
    }

    public function search(Request $request): BukuCollection
    {
        $search = $request->input('search');
        $bukus = Buku::query();
        if($search){
            $bukus = $bukus->where(function (Builder $builder) use ($search) {
                $builder->orWhere('judul', 'like', '%' . $search . '%')
                ->orWhere('penulis', 'like', '%' . $search . '%')
                ->orWhere('isbn', 'like', '%' . $search . '%');
            });
        }
        $bukus = $bukus->get();

        return new BukuCollection($bukus);
    }

    public function update(string $isbn, BukuUpdateRequest $request): BukuResource
    {
        $data = $request->validated();
        $user = Auth::user();
        $buku = $this->getBuku($user, $isbn, 'update');
        $data = $request->validated();

        $buku->fill($data);
        $buku->save();

        return new BukuResource($buku);
    }

    public function delete(string $isbn): JsonResponse
    {
        $user = Auth::user();
        $buku = $this->getBuku($user, $isbn, 'delete');
        $buku->delete();

        return response()->json([
            'data' => true
        ], 200);
    }

    public function getListByKategori(string $kategori): JsonResponse
    {
        $bukus = Buku::where('kategori', $kategori)->get();

        return (BukuResource::collection($bukus))->response()->setStatusCode(200);
    }





    public function login($email, $password)
    {
        $user = User::where('email', $email)->first();
        if ($user && Hash::check($password, $user->password)) {
            $user->token = Str::uuid()->toString();
            $user->save();
            Auth::login($user);
            return response()->json([
                'message' => 'login success',
                'data' => $user
            ], 200);
        }
        return response()->json([
            'message' => 'login failed'
        ], 401);
    }
    public function logout()
    {
        Auth::logout();
    }
    public function view()
    {
        $token = "2dcbd000-dca0-46a6-8377-253e9f8870ea";
        // Mengirimkan request dengan Header Authorization
        //Tampilkan response dari request
        // dump($response->json());
        dump(Auth::user());
    }
}
