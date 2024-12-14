<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request) : JsonResponse {
        $data = $request->validated();

        if (User::where('nama', $data['nama'])->count() == 1) {
            //ada di database satu nama yang sama
            throw new HttpResponseException(response([
                'errors' => [
                    'nama' => ["nama already registered."]
                ]
            ], 400));
               
        }

        $user = new User($data);
        $user->password = Hash::make($data['password']);
        $user->save();

        return (new UserResource($user))->response->setStatusCode(201);

    }
}
