<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionGroups = [
            [
                'name' => 'Country'
            ],
            [
                'name' => 'State'
            ]
        ];

        foreach ($permissionGroups as $permission) {
            $permissionGroup = new PermissionGroup;
            $permissionGroup->name = $permission['name'];
            $permissionGroup->save();
        }
    }
}
