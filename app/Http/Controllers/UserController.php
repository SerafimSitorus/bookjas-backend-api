<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdateProfileRequest;
use App\Http\Requests\UserUpdatePasswordRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\UserUpdateProfilePictureRequest;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request) : JsonResponse {
        $data = $request->validated();

        // if (User::where('nama', $data['nama'])->count() == 1) {
        //     //ada di database satu nama yang sama
        //     throw new HttpResponseException(response([
        //         'errors' => [
        //             'nama' => ["nama {$request['nama']} already registered."]
        //         ]
        //     ], 400));
               
        // }

        $user = new User($data);
        $user->password = Hash::make($data['password']);
        $user->save();

        return (new UserResource($user))->response()->setStatusCode(201);

    }

    public function login(UserLoginRequest $request) : UserResource {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw new HttpResponseException(response([
                'errors' => [
                    'message' => ["email or password wrong"]
                ]
            ], 401));
        }

        $user->token = Str::uuid()->toString();
        $user->save();

        return new UserResource($user);
    }

    public function get() : UserResource {
        $user = Auth::user();
        return new UserResource($user);
    }

    public function logout() : JsonResponse {
        $user = Auth::user();
        $user->token = null;
        $user->save();
        Auth::logout($user);

        return response()->json(([
            'data' => true
        ]), 200);
    }

    public function updatePassword(UserUpdatePasswordRequest $request) : JsonResponse {
        $data = $request->validated();

        $user = Auth::user();

        if (!$user) {
            return response()->json(['errors' => 'User not found'], 404);
        }

        if (!Hash::check($data['current_password'], $user->password)) {
            throw new HttpResponseException(response([
                'errors' => "Password lama tidak cocok"
            ], 400));
        }

        $user->password = Hash::make($data['password']);
        

        $user->save();

        return response()->json(['message' => 'Password berhasil diubah']);
    }

    public function updateProfile(UserUpdateProfileRequest $request) : JsonResponse {
        $data = $request->validated();
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'errors' => [
                    'message' => 'User not found'
                ]],404);
        }

        $rules = ['nama' => ['required', 'string', 'max:255'], 'email' => ['required']];

        if($data['email'] != $user->email){
            $rules['email'] = ['unique:users'];
        }

        try {
            $data = $request->validate($rules);
        } catch (\Throwable $th) {
            return response()->json(['errors' => ['email' => 'Email sudah ada']], 400);
        }

        $user->nama = $data['nama'];
        $user->email = $data['email'];
        $user->save();

        return response()->json(['message' => 'Profile berhasil diubah']);
    }

    public function updateProfilePicture(UserUpdateProfilePictureRequest $request) : JsonResponse {
        $file = $request->validated();
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $filename =  $user->id . '_' . time() . '_' . $file->getClientOriginalName();  
        $file->storeAs('public/profilePic', $filename);

        $user->foto_profile = $filename;

        // if (isset($data['nama'])) {
        //     $user->nama = $data['nama'];
        // }

        // if (isset($data['email'])) {
        //     $user->email = $data['email']; 
        // }

        $user->save();

        return response()->json([
            'message' => 'Profile picture updated succesfully'
        ], 200);
    }

    public function getProfilePicture() : JsonResponse {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if ($user->foto_profil && Storage::exist('public/profilePic/' . $user->foto_profil)) {
            $fotoProfileUrl = Storage::url('profilePic/' . $user->foto_profil);
        }else {
            $fotoProfileUrl = url('/Storage/profilePic/defaultProfile.png');
        }

        return response()->json([
            'foto_profil_url' => $fotoProfileUrl
        ], 200);
    }

    public function hitungJumlah(): JsonResponse {

        $jumlah_buku =  Buku::count();

        $bulan_ini = Carbon::now()->month;
        $peminjaman = Peminjaman::all();
        $jumlah_peminjaman = 0;
        foreach ($peminjaman as $p) {
            if (Carbon::parse($p->tanggal_peminjaman)->month == $bulan_ini) {
                $jumlah_peminjaman++;
            };
        }

        $jumlah_pembaca = User::where('status', 'User')->count();

        $jumlah_pustakawan = User::where('status', 'Admin')->count();
        return response()->json([
            "jumlah_peminjaman" => $jumlah_peminjaman,
            "jumlah_pembaca" => $jumlah_pembaca,
            "jumlah_pustakawan" => $jumlah_pustakawan,
            "jumlah_buku" => $jumlah_buku
        ]);
        
    }


}
