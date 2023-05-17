<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function login(Request $request, User $model): Response
    {
        $datavalidated = Validator::make($request->post(), [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);
        if ($datavalidated->fails())
            return response(['message' => $datavalidated->errors(), 'status' => 417], 417);

        $datavalidated = $datavalidated->validated();

        if ($token = $this->checkExistUser($datavalidated))
            return response(['message' => 'successfully login', 'token' => $this->createToken($token), 'status' => 200], 200);
        else
            return $this->signup($datavalidated);
    }

    public function signup($data): Response
    {
        // hashing password
        $data = array_merge($data, ['password' => Hash::make($data['password'])]);
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

    private function checkExistUser($data): string|bool
    {
        return JWTAuth::attempt($data);
    }

    public function refreshToken(): Response
    {
        // check don't exist response, authentication user with jwt
        $user = ($this->handleToken()) ? JWTAuth::authenticate() : [];

        if ($user) {
            $createToken = JWTAuth::fromUser($user);
            return response(['token' => $this->createToken($createToken, $user), 'status' => 200], 200);
        } else {
            return response(['message' => 'User not found', 'status' => 401], 401);
        }
    }

    public function handleToken(): Response
    {
        if (!request()->header('Authorization'))
            return response(['message' => 'bearer token is required', 'status' => 500], 500);

        // regenerate a new token
        try {
            JWTAuth::setToken(JWTAuth::refresh());
            return response(['message' => 'Token refreshed successfully', 'status' => 200], 200);
        } catch (\Exception $e) {
            return response(['message' => 'Failed to refresh token', 'status' => 401], 401);
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
