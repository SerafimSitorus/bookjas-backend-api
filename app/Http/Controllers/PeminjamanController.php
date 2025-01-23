<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\ViewPeminjaman;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\SearchUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\PeminjamanResource;
use App\Http\Requests\PeminjamanCreateRequest;
use App\Http\Resources\ViewPeminjamanCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Requests\PeminjamanPengembalianRequest;
use App\Http\Resources\SearchBuku;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Resources\ViewPeminjaman as ResourcesViewPeminjaman;
use App\Models\Buku;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller {
    public function create(PeminjamanCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();
        $buku = Buku::where('isbn', $data['isbn'])->first();

        if (!$buku) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'Buku Tidak Ditemukan'
                    ]
                ]
            ])->setStatusCode(404));
        }
        if (!$user) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'Pengguna Tidak Ditemukan'
                    ]
                ]
            ])->setStatusCode(404));
        }

        $peminjaman = Peminjaman::where('user_id', $user->id)->where('isbn', $buku->isbn)->where('status', 'dipinjam')->first();
        if ($peminjaman) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'Pengguna sudah meminjam buku ini'
                    ]
                ]
            ])->setStatusCode(404));
        }

        $data['tanggal_peminjaman'] = Carbon::now()->format('Y-m-d');
        $data['user_id'] = $user->id;
        $peminjaman = new Peminjaman($data);

        if ($buku->jumlah_tersedia == 0) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'Buku Tidak Tersedia'
                    ]
                ]
            ])->setStatusCode(404));
        }
        $buku->jumlah_tersedia = $buku->jumlah_tersedia - 1;

        $buku->save();
        $peminjaman->save();
        // dd($data);

        return response()->json(['message' => 'Peminjaman berhasil ditambahkan']);
    }

    public function searchBuku(Request $request): JsonResponse
    {
        $judul = $request->input('search');
        if ($judul) {
            $buku = Buku::query();
            $buku = $buku->where(function (Builder $builder) use ($judul) {
                $builder->orWhere('judul', 'like', '%' . $judul . '%');
            });
        }
        $buku = $buku->get();
        if ($buku->isEmpty()) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'not found'
                    ]
                ]
            ])->setStatusCode(404));
        }
        // dd('ahh', $pengguna, $buku);
        return (SearchBuku::collection($buku))->response()->setStatusCode(200);
    }

    public function searchUser(Request $request): JsonResponse {
        $pengguna = $request->input('search');
        if ($pengguna) {
            $user = User::query();
            $user = $user->where(function (Builder $builder) use ($pengguna) {
                $builder->orWhere('nama', 'like', '%' . $pengguna . '%')
                    ->orWhere('email', 'like', '%' . $pengguna . '%');
            });
        }
        $user = $user->get();
        if ($user->isEmpty()) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'not found'
                    ]
                ]
            ])->setStatusCode(404));
        }
        // dd('ahh', $pengguna, $user);
        return (SearchUser::collection($user))->response()->setStatusCode(200);
    }

    public function search(/* Request $request */): ViewPeminjamanCollection {
        /* $search = $request->input('search');
        $peminjaman = ViewPeminjaman::query();
        
        if ($search) {
            $peminjaman = $peminjaman->where(function (Builder $builder) use ($search) {
                $builder->orWhere('judul', 'like', '%' . $search . '%')
                    ->orWhere('peminjam', 'like', '%' . $search . '%');
            });
        }

        $peminjaman = $peminjaman->orderBy('updated_at', 'DESC')->get(); */

        $peminjaman = DB::table('peminjaman as a')
            ->select(
                'a.user_id',
                'b.isbn',
                'b.sampul',
                'b.judul',
                'b.penulis',
                'c.nama as peminjam',
                'a.tanggal_peminjaman',
                'a.tanggal_pengembalian',
                'a.status',
                'a.created_at',
                'a.updated_at'
            )
            ->join('bukus as b', 'a.isbn', '=', 'b.isbn')
            ->join('users as c', 'a.user_id', '=', 'c.id')
            ->orderBy('a.updated_at', 'DESC')
            ->get();

        if ($peminjaman->isEmpty()) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'message' => [
                        'not found'
                    ]
                ]
            ])->setStatusCode(404));
        }

        foreach ($peminjaman as $p) {
            $tanggal_pinjam = Carbon::parse($p->tanggal_peminjaman);
            $tenggat = $tanggal_pinjam->addDays(7);
            $sisa_waktu = $tenggat->diffInDays(Carbon::now()) + 1;
            $p->tenggat = $tenggat->format('Y-m-d');
            if($sisa_waktu == 1) {
                $p->hari_tersisa = "Tenggat Hari Ini";
            }else if($tenggat->isPast() && $p->status == "dipinjam"){
                $p->hari_tersisa = "Lewat Tenggat"; 
            }else{
                $p->hari_tersisa = $sisa_waktu ." Hari Tersisa" ;
            }
        }

        return new ViewPeminjamanCollection($peminjaman);
    }

    public function getByUser(string $user_id): JsonResponse {
        $peminjaman = DB::table('peminjaman as a')
            ->select(
                'a.user_id',
                'b.isbn',
                'b.sampul',
                'b.judul',
                'b.penulis',
                'c.nama as peminjam',
                'a.tanggal_peminjaman',
                'a.tanggal_pengembalian',
                'a.status',
                'a.created_at',
                'a.updated_at'
            )
            ->join('bukus as b', 'a.isbn', '=', 'b.isbn')
            ->join('users as c', 'a.user_id', '=', 'c.id')
            ->where('a.user_id', $user_id)
            ->orderBy('a.created_at', 'DESC')
            ->get();

        // $peminjaman = ViewPeminjaman::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        // $waktu =  $peminjaman;

        foreach ($peminjaman as $p) {
            $tanggal_pinjam = Carbon::parse($p->tanggal_peminjaman);
            $tenggat = $tanggal_pinjam->addDays(7);
            $sisa_waktu = $tenggat->diffInDays(Carbon::now()) + 1;
            $p->tenggat = $tenggat->format('Y-m-d');
            if($sisa_waktu == 1) {
                $p->hari_tersisa = "Tenggat Hari Ini";
            }else if($tenggat->isPast() && $p->status == "dipinjam"){
                $p->hari_tersisa = "Lewat Tenggat"; 
            }else{
                $p->hari_tersisa = $sisa_waktu ." Hari Tersisa" ;
            }
        }

        return (ResourcesViewPeminjaman::collection($peminjaman))->response()->setStatusCode(200);
    }

    public function kembalikan(string $user_id, string $isbn): JsonResponse {
        $user = Auth::user();
        if ($user->status != 'Admin') {
            throw new HttpResponseException(response([
                'errors' => "Unauthorized"
            ], 401));
        }
        $buku = Buku::where('isbn', $isbn)->first();
        $buku->jumlah_tersedia = $buku->jumlah_tersedia + 1;
        $buku->save();
        $peminjaman = Peminjaman::where('user_id', $user_id)->where('isbn', $isbn)->update([
            'tanggal_pengembalian' => Carbon::now()->format('Y-m-d'),
            'status' => 'dikembalikan'
        ]);
        // return response()->json([$buku, $peminjaman]);
        return response()->json(['message' => 'Buku berhasi dikembalikan']);
    }
}