<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\AppUser;
use App\Models\Responder;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Find admin by email
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json(['message' => 'Invalid email or password','status'=>false], 401);
        }

        // Store admin data in session
        Session::put('admin_id', $admin->id);

        return response()->json(['message' => 'Login successful', 'admin' => $admin, 'status'=> true]);
    }

    public function AddUser(Request $request)
    {
        $check =  AppUser::where('email',$request->email)->first();
        if(!empty($check)){
            return response()->json(['message' => 'Email Already Exist', 'status' => false]);
        }

        $data = new AppUser();
        $data->name = $request->name;
        $data->email =$request->email;
        $data->password = $request->password;
        $data->role = ucfirst($request->role);
        $data->save();

        return response()->json(['message' => 'User Added Successfully', 'status'=> true]);
    }

    public function GetUser(Request $request)
    {
        $data = AppUser::paginate(10); // Show 10 users per page

        return response()->json([
            'message' => '',
            'data' => $data->items(),  // Get the actual records
            'status' => true,
            'pagination' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
                'next_page_url' => $data->nextPageUrl(),
                'prev_page_url' => $data->previousPageUrl(),
            ]
        ]);
    }

    public function UpdateUser(Request $request)
    {
        $checkCurrentUser = AppUser::where('email', $request->email)
            ->where('id', $request->userid)
            ->first();
            if(!$checkCurrentUser){
                $check = AppUser::where('email', $request->email)->first();
                if (!empty($check)) {
                    return response()->json(['message' => 'Email Already Exist', 'status' => false]);
                }
            }
        $user = AppUser::where('id', $request->userid)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)){
            $user->password = $request->password;
        }
        $user->role = ucfirst($request->role);
        $user->save();

        return response()->json(['message' => 'User Updated Successfully', 'status' => true]);
    }

    public function AddResponder(Request $request)
    {
        $check =  Responder::where('username', $request->username)->first();
        if (!empty($check)) {
            return response()->json(['message' => 'Username Already Exist', 'status' => false]);
        }

        $data = new Responder();
        $data->name = $request->name;
        $data->username = $request->username;
        $data->password = $request->password;
        $data->type = ucfirst($request->role);
        $data->save();

        return response()->json(['message' => 'Responder Added Successfully', 'status' => true]);
    }

    public function GetResponder(Request $request)
    {
        $data = Responder::paginate(10); // Show 10 responders per page

        return response()->json([
            'message' => '',
            'data' => $data->items(),  // Extract actual records
            'status' => true,
            'pagination' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
                'next_page_url' => $data->nextPageUrl(),
                'prev_page_url' => $data->previousPageUrl(),
            ]
        ]);
    }

    public function UpdateResponder(Request $request)
    {
        $checkCurrentUser = Responder::where('username', $request->username)
            ->where('id', $request->responderid)
            ->first();
        if (!$checkCurrentUser) {
            $check = Responder::where('username', $request->username)->first();
            if (!empty($check)) {
                return response()->json(['message' => 'Username Already Exist', 'status' => false]);
            }
        }
        $user = Responder::where('id', $request->responderid)->first();
        $user->name = $request->name;
        $user->username = $request->username;
        if (!empty($request->password)) {
            $user->password = $request->password;
        }
        $user->type = ucfirst($request->role);
        $user->save();

        return response()->json(['message' => 'Responder Updated Successfully', 'status' => true]);
    }
}
