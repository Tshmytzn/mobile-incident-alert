<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incidents;
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
}
