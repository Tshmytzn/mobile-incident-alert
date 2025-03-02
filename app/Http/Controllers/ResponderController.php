<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Responder;
use App\Models\Incidents;

class ResponderController extends Controller
{

    public function login(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message'=>'User credential is required', 'errors' => $validator->errors()], 422);
        }

        // Find responder by username
        $responder = Responder::where('username', $request->username)->first();

        if (!$responder || !Hash::check($request->password, $responder->password)) {
            return response()->json(['message' => 'Invalid username or password', 'status' => false], 401);
        }

        // Store responder data in session
        Session::put('responder_id', $responder->id);

        return response()->json(['message' => 'Login successful', 'responder' => $responder, 'status' => true]);
    }

}
