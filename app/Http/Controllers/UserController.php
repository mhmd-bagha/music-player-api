<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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

    private function checkExistUser($email): bool
    {
        return User::where('email', $email)->first()->exists();
    }
}
