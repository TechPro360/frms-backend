<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardStatsController extends Controller
{
    public function index(Request $request)
    {
        // For kickoff MVP, we provide simulated live data for the dashboard
        // Once the PPMP and Obligation tables are heavily seeded, we'll swap to live aggregation.
        return response()->json([
            'total_fund_allocated' => 85000000.00,
            'total_obligations' => 42500000.00,
            'total_disbursements' => 31200000.00,
            'active_requisitions' => 142,
            'burn_rate_percent' => 50,
            'recent_activity' => [
                ['id' => 1, 'type' => 'OBR', 'description' => 'MISO Equipment Upgrade', 'amount' => 450000.00, 'status' => 'Certified', 'time' => '10 mins ago'],
                ['id' => 2, 'type' => 'BUR', 'description' => 'Research Grant Dispersal', 'amount' => 1200000.00, 'status' => 'Pending Box A', 'time' => '1 hour ago'],
                ['id' => 3, 'type' => 'PPMP', 'description' => 'Library Book Acquisition', 'amount' => 300000.00, 'status' => 'Approved', 'time' => '3 hours ago'],
            ]
        ]);
    }
}
