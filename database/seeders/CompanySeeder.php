<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'Empresa 1',
                'email' => 'empresa@called.com',
                'document' => '000.000.00001-00',
                'trade_name' => 'Empresa Matriz',
                'phone' => '71 00000 0000'
            ],

            [
                'name' => 'Empresa 2 ',
                'email' => 'empresa2@called.com',
                'document' => '000.000.00002-00',
                'trade_name' => 'Empresa Filial',
                'phone' => '71 10000 0000'
            ],
        ];
        foreach ($companies as $company) {

            Company::create($company);

        }
    }
}