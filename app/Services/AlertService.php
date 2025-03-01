<?php

namespace App\Services;

use App\Models\Incidents;

class AlertService
{
    public function getPendingAlerts()
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
}
