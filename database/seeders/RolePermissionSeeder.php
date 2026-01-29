<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                "permission_id" => 1,
                "role_id" => 2
            ],
            [
                "permission_id" => 6,
                "role_id" => 2
            ],

        ];
        foreach ($permissions as $permission) {
            DB::table("permission_role")->insert($permission);
        }
    }
}
