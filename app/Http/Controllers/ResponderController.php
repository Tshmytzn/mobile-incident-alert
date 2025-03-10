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

    public function logout(Request $request)
    {
        Session::forget('responder_id');
        return response()->json(['message' => 'Logout successful','route'=>'/responder', 'status' => true]);
    }

    public function GetProfile()
    {
        $responder_id = Session::get('responder_id');
        $data = Responder::find($responder_id);
        return response()->json(['message' => 'Profile retrieved successfully', 'data' => $data, 'status'=>true]);
    }

    public function UpdateProfile(Request $request)
    {
        $responder_id = Session::get('responder_id');
        $data = Responder::find($responder_id);
        $data->name = strtoupper($request['fullname']);
        $data->username = $request['username'];
        $data->save();
        return response()->json(['message' => 'Profile updated successfully', 'status'=>true]);
    }

    public function UpdateResponderPassword(Request $request)
    {
        $responder_id = Session::get('responder_id');
        $responder = Responder::find($responder_id);

        if (!$responder) {
            return response()->json(['message' => 'User not found', 'status' => false], 404);
        }

        if (!Hash::check($request->old_password, $responder->password)) {
            return response()->json(['message' => 'Old password is incorrect', 'status' => false], 400);
        }

        $responder->password = $request->new_password;
        $responder->save();

        return response()->json(['message' => 'Password updated successfully', 'status' => true]);
    }


    public function GetResponderReports(Request $request)
    {
        $query = Incidents::query();

        $query->where('status', 'Resolved');

        // Search functionality
        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                ->orWhere('type', 'like', "%{$search}%")
                ->orWhere('reported_at', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%");
            });
        }

        // Handle pagination
        $perPage = $request->input('length', 10); // Number of records per page
        $start = $request->input('start', 0); // Offset
        $currentPage = ($start / $perPage) + 1; // Calculate current page

        // Paginate the data
        $data = $query->paginate($perPage, ['*'], 'page', $currentPage);

        return response()->json([
            'message' => '',
            'data' => $data->items(), // Return only the paginated data
            'status' => true,
            'pagination' => [
                'draw' => intval($request->input('draw')), // Ensure draw is returned for DataTables
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
            ]
        ]);
    }
}
