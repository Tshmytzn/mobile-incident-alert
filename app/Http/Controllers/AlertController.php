<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incidents;
use App\Models\Responder;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class AlertController extends Controller
{
    public function SendAlert(Request $request)
    {
        $now = Carbon::now('Asia/Hong_Kong');

        $data = new Incidents();
        $data->user_id = Session::get('user_id');
        $data->type = 'Emergency';
        $data->description = 'This is an emergency alert';
        $data->longitude = $request->lng;
        $data->latitude = $request->lat;
        $data->reported_at = $now->format('Y-m-d H:i:s');
        $data->save();

        return response()->json(['message' => 'Alert sent successfully', 'status' => true]);
    }

    public function SendManualAlert(Request $request)
    {
        $now = Carbon::now('Asia/Hong_Kong');

        $data = new Incidents();
        $data->user_id = Session::get('user_id');
        $data->type = $request->type;
        $data->description = 'This is an emergency alert';
        $data->longitude = $request->lng;
        $data->latitude = $request->lat;
        $data->reported_at = $now->format('Y-m-d H:i:s');
        $data->save();

        return response()->json(['message' => 'Alert sent successfully', 'status' => true]);
    }

    public function GetAlerts()
    {
        $data = Incidents::where('incidents.status', 'Pending')
            ->join('app_user', 'incidents.user_id', '=', 'app_user.id')
            ->select(
                'incidents.*',
                'app_user.name',
                'app_user.role',
                'app_user.phone_number',
                'app_user.address',
                'app_user.emergency_contact_phone'
            )
            ->get();

        return response()->json(['data' => $data]);
    }

    public function GetAllAlerts()
    {
        $data = Incidents::whereIn('incidents.status', ['Pending', 'In Progress'])
            ->join('app_user', 'incidents.user_id', '=', 'app_user.id')
            ->select(
                'incidents.*',
                'app_user.name',
                'app_user.role',
                'app_user.phone_number',
                'app_user.address',
                'app_user.emergency_contact_phone'
            )
            ->get();

        return response()->json(['data' => $data]);
    }

    public function GetSolveAlerts(Request $request)
    {
        // Base query to fetch resolved incidents
        $data = Incidents::where('incidents.status', 'Resolved')
            ->join('app_user', 'incidents.user_id', '=', 'app_user.id')
            ->select(
                'incidents.*',
                'app_user.name',
                'app_user.role',
                'app_user.phone_number',
                'app_user.address',
                'app_user.emergency_contact_phone'
            );

        // Apply search if provided
        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $data->where(function ($q) use ($search) {
                $q->where('app_user.name', 'like', "%{$search}%")
                    ->orWhere('app_user.username', 'like', "%{$search}%")
                    ->orWhere('incidents.type', 'like', "%{$search}%");
            });
        }

        // Handle pagination
        $perPage = $request->input('length', 10); // Number of records per page
        $start = $request->input('start', 0); // Offset
        $currentPage = ($start / $perPage) + 1; // Calculate current page

        // Paginate the query
        $data = $data->paginate($perPage, ['*'], 'page', $currentPage);

        // Return the response with pagination details
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


    public function GetAlertsByUser(Request $request)
    {
        $query = Incidents::query()->where('user_id', Session::get('user_id'));

        if ($request->has('search') && !empty($request->search['value'])) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('type', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('report_at', 'like', "%{$search}%");
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

    public function GetAlertsForResponder()
    {
        $data = Incidents::where('incidents.status', 'In Progress')->where('responder_id', Session::get('responder_id'))
            ->join('app_user', 'incidents.user_id', '=', 'app_user.id')
            ->select(
                'incidents.*',
                'app_user.name',
                'app_user.role',
                'app_user.phone_number',
                'app_user.address',
                'app_user.emergency_contact_phone'
            )
            ->get();

        return response()->json(['data' => $data]);
    }

    public function ConfirmAlert(Request $request)
    {
        $incident = Incidents::find($request->incident_id);
        $incident->status = 'Resolved';
        $incident->save();

        $responder = Responder::find(Session::get('responder_id'));
        $responder->status = true;
        $responder->save();

        return response()->json(['message' => 'Incident confirmed successfully', 'status' => true]);
    }
}
