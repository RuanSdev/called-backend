<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_company = [
            [
                "user_id" => 1,
                "company_id" => "1",
            ],
            [
                "user_id" => 2,
                "company_id" => "2",
            ]
        ];

        foreach ($user_company as $value) {
            DB::table("user_company")->insert($value);

        }

    }
}
