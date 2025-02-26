<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\AppUser;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function login(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message'=>'User credential is required', 'errors' => $validator->errors()], 422);
        }

        // Find admin by email
        $user = AppUser::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid email or password', 'status' => false], 401);
        }

        // Store admin data in session
        Session::put('user_id', $user->id);

        return response()->json(['message' => 'Login successful', 'user' => $user, 'status' => true]);
    }

    public function logout(Request $request)
    {
        Session::forget('user_id');
        return response()->json(['message' => 'Logout successful','route'=>'/login', 'status' => true]);
    }

}
