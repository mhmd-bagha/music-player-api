<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function login(Request $request, User $model): JsonResponse
    {
        $dataValidated = Validator::make($request->post(), [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);
        if ($dataValidated->fails())
            return response()->json(['message' => $dataValidated->errors(), 'status' => 417], 417);

        $dataValidated = $dataValidated->validated();

        if ($token = $this->checkExistUser($dataValidated))
            return response()->json(['message' => 'successfully login', 'token' => $this->createToken($token), 'status' => 200]);
        else
            return $this->signup($dataValidated);
    }

    public function signup($data): JsonResponse
    {
        // hashing password
        $data = array_merge($data, ['password' => Hash::make($data['password'])]);
        $createUser = User::create($data);
        $jwtToken = JWTAuth::fromUser($createUser);

        if ($createUser)
            return response()->json(['message' => 'user created successfully', 'token' => $this->createToken($jwtToken, $createUser), 'status' => 201], 201);
        else
            return response()->json(['message' => 'an error has occurred', 'status' => 422], 422);
    }

    public function getUser(): JsonResponse
    {
        if (!$this->getUserRedis()) {

            $user = auth()->user();
            $this->setUserRedis($user);

        } else {

            $user = $this->getUserRedis();

        }
        return response()->json(['user' => $user, 'status' => 200]);
    }

    public function getUserRedis()
    {
        $user = Redis::get('user');
        return json_decode($user);
    }

    public function setUserRedis($user)
    {
        Redis::set('user', $user);
    }

    private function checkExistUser($data): string|bool
    {
        return JWTAuth::attempt($data);
    }

    public function refreshToken(): JsonResponse
    {
        // check don't exist response, authentication user with jwt
        $user = ($this->handleToken()) ? JWTAuth::authenticate() : [];

        if ($user) {
            $createToken = JWTAuth::fromUser($user);
            return response()->json(['token' => $this->createToken($createToken, $user), 'status' => 200]);
        } else {
            return response()->json(['message' => 'User not found', 'status' => 401], 401);
        }
    }

    public function handleToken(): JsonResponse
    {
        if (!request()->header('Authorization'))
            return response()->json(['message' => 'bearer token is required', 'status' => 500], 500);

        // regenerate a new token
        try {
            JWTAuth::setToken(JWTAuth::refresh());
            return response()->json(['message' => 'Token refreshed successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to refresh token', 'status' => 401], 401);
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
