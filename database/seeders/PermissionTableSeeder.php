<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'dashboard_index',
                'permission_group_id' => PermissionGroup::where('name', 'Dashboard')->first()->id,
            ],
            [
                'name' => 'konfigurasi_index',
                'permission_group_id' => PermissionGroup::where('name', 'Konfigurasi')->first()->id,
            ],
            [
                'name' => 'user_index',
                'permission_group_id' => PermissionGroup::where('name', 'User')->first()->id,
            ],
            [
                'name' => 'role_index',
                'permission_group_id' => PermissionGroup::where('name', 'Role')->first()->id,
            ],
            [
                'name' => 'permission_index',
                'permission_group_id' => PermissionGroup::where('name', 'Permission')->first()->id,
            ],
            [
                'name' => 'group_permission_index',
                'permission_group_id' => PermissionGroup::where('name', 'Group Permission')->first()->id,
            ],
            [
                'name' => 'pengaturan_index',
                'permission_group_id' => PermissionGroup::where('name', 'Pengaturan')->first()->id,
            ],

        ];

        foreach ($permissions as $value) {
            $permission = new Permission;
            $permission->name = $value['name'];
            $permission->permission_group_id = $value['permission_group_id'];
            $permission->save();
        }
    }
}
