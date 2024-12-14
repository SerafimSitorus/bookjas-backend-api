<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request) : JsonResponse {
        $data = $request->validated();

        if (User::where('nama', $data['nama'])->count() == 1) {
            //ada di database satu nama yang sama
            throw new HttpResponseException(response([
                'errors' => [
                    'nama' => ["nama {$request['nama']} already registered."]
                ]
            ], 400));
               
        }

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
}