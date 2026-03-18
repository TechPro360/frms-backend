<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('CLSU-FRMS-2026!');

        DB::table('users')->insert([
            [
                'username'   => 'director',
                'full_name'  => 'FMS Director Admin',
                'role_code'  => 'FMS Director',
                'office'     => null,
                'password'   => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'budget_head',
                'full_name'  => 'Budget Office Head',
                'role_code'  => 'Budget Head',
                'office'     => null,
                'password'   => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'clerk',
                'full_name'  => 'Budget Clerk One',
                'role_code'  => 'Budget Clerk',
                'office'     => null,
                'password'   => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'miso_requestor',
                'full_name'  => 'MISO Department Head',
                'role_code'  => 'Requesting Office',
                'office'     => 'MISO',
                'password'   => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'coed_requestor',
                'full_name'  => 'College of Education Head',
                'role_code'  => 'Requesting Office',
                'office'     => 'College of Education',
                'password'   => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'cashier',
                'full_name'  => 'Cashier Office Admin',
                'role_code'  => 'Cashier',
                'office'     => null,
                'password'   => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'it_admin',
                'full_name'  => 'IT Administrator',
                'role_code'  => 'IT Admin',
                'office'     => null,
                'password'   => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->call([
            PilotSeeder::class,
        ]);
    }
}
