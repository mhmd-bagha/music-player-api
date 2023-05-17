<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function login(Request $request, User $model)
    {
        $datavalidated = Validator::make($request->post(), [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);
        if ($datavalidated->fails())
            return response(['message' => $datavalidated->errors(), 'status' => 417], 417);

        $datavalidated = $datavalidated->validated();

        // convert password to hash
        array_merge($datavalidated, ['password' => Hash::make($datavalidated['password'])]);

        if ($token = $this->checkExistUser($datavalidated))
            return response(['message' => 'successfully login', 'token' => $this->createToken($token), 'status' => 200], 200);
        else
            return $this->signup($datavalidated);
    }

    public function signup($data): Response
    {
        $createUser = User::create($data);
        $jwtToken = JWTAuth::fromUser($createUser);

        if ($createUser)
            return response(['message' => 'user created successfully', 'token' => $this->createToken($jwtToken, $createUser), 'status' => 201], 201);
        else
            return response(['message' => 'an error has occurred', 'status' => 422], 422);
    }

    public function getUser(): Response
    {
        return response(['user' => auth()->user(), 'status' => 200], 200);
    }

    private function checkExistUser($data): string
    {
        return JWTAuth::attempt($data);
    }

    public function refreshToken()
    {
        if (!request()->header('Authorization'))
            return response(['message' => 'bearer token is required', 'status' => 500], 500);

        // check the has expired token and regenerate token then get user
        try {
            $user = JWTAuth::authenticate();
        } catch (TokenExpiredException $e) {
            JWTAuth::setToken(JWTAuth::refresh());
            $user = JWTAuth::authenticate();
        }

        if ($user) {
            $createToken = JWTAuth::fromUser($user);
            return response(['token' => $this->createToken($createToken, $user), 'status' => 200], 200);
        } else {
            return response(['message' => 'this is user not found', 'status' => 401], 401);
        }
    }

    protected function createToken(string $token, $user = null): array
    {
        $user = ($auth = auth()->user()) ? $auth : $user;

        return [
            'access_token' => $token,
            'user' => $user
        ];
    }
}
