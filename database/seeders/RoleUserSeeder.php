<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_user = [
            [
                'role_id' => 1,
                'user_id' => 1,
            ],

            [
                'role_id' => 2,
                'user_id' => 2,
            ]
        ];
        foreach ($role_user as $pivot) {
            DB::table('role_user')->insert($pivot);

        }
    }
}