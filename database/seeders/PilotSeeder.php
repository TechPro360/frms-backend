<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PilotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Fund Clusters
        $fundClusters = [
            ['code' => '101', 'name' => 'Government Appropriations (GA)', 'resets_annually' => true],
            ['code' => '161', 'name' => 'Income-Generating Projects (IGP)', 'resets_annually' => false],
            ['code' => '163', 'name' => 'Specific Fixed Funds (Pilot)', 'resets_annually' => false],
            ['code' => '164', 'name' => 'CLSU Performance-Based Income', 'resets_annually' => false],
            ['code' => 'Trust Fund', 'name' => 'Externally Funded/Restricted', 'resets_annually' => false],
        ];

        foreach ($fundClusters as $cluster) {
            DB::table('fund_clusters')->updateOrInsert(
                ['code' => $cluster['code']],
                [
                    'name' => $cluster['name'],
                    'resets_annually' => $cluster['resets_annually'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // 2. Seed Basic UACS Objects (Common ones)
        $uacsObjects = [
            ['object_code' => '5020301000', 'account_title' => 'Office Supplies Expenses'],
            ['object_code' => '5020101000', 'account_title' => 'Traveling Expenses - Local'],
            ['object_code' => '5020201000', 'account_title' => 'Training Expenses'],
            ['object_code' => '5010101001', 'account_title' => 'Salaries and Wages - Regular'],
        ];

        foreach ($uacsObjects as $uacs) {
            DB::table('uacs_objects')->updateOrInsert(
                ['object_code' => $uacs['object_code']],
                [
                    'account_title' => $uacs['account_title'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // 3. Seed Basic Responsibility Centers
        $respCenters = [
            ['code' => '01', 'name' => 'Office of the President'],
            ['code' => '02', 'name' => 'Financial Management Services'],
            ['code' => '03', 'name' => 'Budget Office'],
            ['code' => '04', 'name' => 'Accounting Office'],
        ];

        foreach ($respCenters as $rc) {
            DB::table('responsibility_centers')->updateOrInsert(
                ['code' => $rc['code']],
                [
                    'name' => $rc['name'],
                    'display_name' => $rc['name'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
