<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'List-users'],
            ['name' => 'Create-user'],
            ['name' => 'Update-user'],
            ['name' => 'Delete-user'],
            ['name' => 'Get-user'],
            ['name' => 'List-companies'],
            ['name' => 'Create-company'],
            ['name' => 'Update-company'],
            ['name' => 'Delete-company'],
            ['name' => 'Get-company'],

        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
