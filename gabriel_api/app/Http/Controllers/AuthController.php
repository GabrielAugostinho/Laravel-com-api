<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Expr\Throw_;

class AuthController extends Controller
{
    public function login(Request $request) {
        // $credentials = $request->only([
        //     'name',
        //     'email',
        //     'password',
        //     'device_name'
        // ]);

        $user = User::where('email', $request->email)->first();
        if (! $user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['ta errado porra']
            ]);
        }

        // //$user->tokens()->delete();

        $token = $user->createToken($request->email)->plainTextToken;
        return response()->json([
            'token' => $token,
        ]);
    }

}
