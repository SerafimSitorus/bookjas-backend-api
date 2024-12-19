<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\ViewPeminjaman;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\PeminjamanResource;
use App\Http\Requests\PeminjamanCreateRequest;
use App\Http\Resources\ViewPeminjamanCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Requests\PeminjamanPengembalianRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Resources\ViewPeminjaman as ResourcesViewPeminjaman;

class PeminjamanController extends Controller
{
    public function create(PeminjamanCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $peminjaman = new Peminjaman($data);
        $peminjaman->save();
        // dd($data);

        return (new PeminjamanResource($peminjaman))->response()->setStatusCode(201);
    }
    public function search(Request $request): ViewPeminjamanCollection
    {
        $search = $request->input('search');
        $peminjaman = ViewPeminjaman::query();
        if ($search) {
            $peminjaman = $peminjaman->where(function (Builder $builder) use ($search) {
                $builder->orWhere('judul', 'like', '%' . $search . '%')
                    ->orWhere('peminjam', 'like', '%' . $search . '%');
            });
        }
        $peminjaman = $peminjaman->get();

        return new ViewPeminjamanCollection($peminjaman);
    }

    public function getByUser(string $user_id): JsonResponse
    {
        $peminjaman = ViewPeminjaman::where('user_id', $user_id)->get();
        // dd(ResourcesViewPeminjaman::collection($peminjaman));
        return (ResourcesViewPeminjaman::collection($peminjaman))->response()->setStatusCode(200);
    }
    public function kembalikan(string $user_id, string $isbn, PeminjamanPengembalianRequest $request): PeminjamanResource
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

        $peminjaman = Peminjaman::where('user_id', $user_id)->where('isbn', $isbn)->first();
        // dd($peminjaman, $user_id, $isbn);
        $peminjaman->update([
            'tanggal_pengembalian' => Carbon::now()->format('Y-m-d'),
            'status' => 'dikembalikan'
        ]);

        return new PeminjamanResource($peminjaman);
    }



}
