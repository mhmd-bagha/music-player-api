<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request, User $model)
    {
        $datavalidated = Validator::make($request->post(), [
            'email' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

    }

    public function signup($data): string
    {
        $createUser = User::create($data);
        if ($createUser)
            return response(['message' => 'user created successfully', 'status' => 201], 201);
        else
            return response(['message' => 'an error has occurred', 'status' => 422], 422);
    }

    private function checkExistUser($email): bool
    {
        return User::where('email', $email)->first()->exists();
    }
}
