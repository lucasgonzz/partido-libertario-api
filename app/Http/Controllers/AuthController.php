<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login(Request $request) {
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password], $request->remember)) {
            $user = User::find($this->userId());
            return response()->json(['user' => $user], 200);
        }
        return response(null, 403);
    }

    function logout() {
        Auth::logout();
        return response(null, 200);
    }

    function updatePassword(Request $request) {
        $user = Auth::user();
        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => bcrypt($request->new_password),
            ]);
            return response()->json(['updated' => true], 200);
        } else {
            return response()->json(['updated' => false], 200);
        }

    }
}
