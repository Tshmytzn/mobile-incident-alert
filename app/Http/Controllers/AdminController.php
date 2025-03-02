<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\AppUser;
use App\Models\Incidents;
use App\Models\Responder;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'User credential is required', 'errors' => $validator->errors()], 422);
        }

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
        $query = AppUser::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%")
                ->orWhere('phone_number', 'like', "%{$search}%");
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
        $query = Responder::query();

        // Handle searching
        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('username', 'like', "%{$search}%")
                ->orWhere('type', 'like', "%{$search}%");
            });
        }

        // Handle pagination
        $perPage = $request->input('length', 10); // Number of records per page
        $start = $request->input('start', 0); // Offset
        $currentPage = ($start / $perPage) + 1; // Calculate current page

        // Paginate the query
        $data = $query->paginate($perPage, ['*'], 'page', $currentPage);

        return response()->json([
            'message' => '',
            'data' => $data->items(),
            'status' => true,
            'pagination' => [
                'draw' => intval($request->input('draw')), // Return draw for DataTables
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
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

    public function logout(Request $request)
    {
        Session::forget('admin_id');
        return response()->json(['message' => 'Logout successful','route'=>'/administrator', 'status' => true]);
    }

    public function GetAdminProfile(){
        $admin = Session::get('admin_id');
        $data = Admin::find($admin);
        return response()->json(['message' => 'Profile Fetched!', 'data'=> $data, 'status' => true]);

    }

    public function UpdateAdminPicture(Request $request)
    {
        $admin_id = Session::get('admin_id');
        $data = Admin::find($admin_id);
        $oldPicture = $data->picture;
        if(!empty($oldPicture)){
            $this->deletePicture('/AdminPicture', $oldPicture);
        }
        $picture = $this->uploadPicture($request->picture, '/AdminPicture');
        $data->picture = $picture['filename'];
        $data->save();
        return response()->json(['message' => 'Profile picture updated successfully', 'status'=>true]);
    }

    public function UpdateAdminProfile(Request $request)
    {
        $admin_id = Session::get('admin_id');
        $data = Admin::find($admin_id);
        $data->name = $request['admin_name'];
        $data->email = $request['admin_email'];
        $data->save();
        return response()->json(['message' => 'Profile updated successfully', 'status'=>true]);
    }

    public function UpdateAdminPassword(Request $request)
    {
        $admin_id = Session::get('admin_id');
        $admin = Admin::find($admin_id);
        
        if (!$admin) {
            return response()->json(['message' => 'Admin not found', 'status' => false], 404);
        }
    
        if (!Hash::check($request->admin_old_password, $admin->password)) {
            return response()->json(['message' => 'Old password is incorrect', 'status' => false], 400);
        }
    
        $admin->password = $request->admin_new_password;
        $admin->save();

        return response()->json(['message' => 'Password updated successfully', 'status' => true]);
    }

    public function AvailableResponder()
    {
        $responder = Responder::where('status', 1)->get();
        return response()->json(['message' => 'Responder available', 'data' => $responder,'status',true]);
    }

    public function AssignResponder(Request $request)
    {
        $incident = Incidents::where('id',$request->incident_id)->first();
        $responder = Responder::where('id', $request->select_responder)->first();
        $responder->status = false;
        $responder->save();
        $incident->responder_id = $responder->id;
        $incident->responder_name = $responder->name;
        $incident->responder_type = $responder->type;
        $incident->status = 'In Progress';
        $incident->save();
        return response()->json(['message' => 'Responder assigned successfully', 'status' => true]);
    }

}
