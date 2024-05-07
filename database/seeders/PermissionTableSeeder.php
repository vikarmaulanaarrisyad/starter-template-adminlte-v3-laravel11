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
                'name' => 'Country Index',
                'permission_group_id' => PermissionGroup::where('name', 'Country')->first()->id,
            ],
            [
                'name' => 'Country Create',
                'permission_group_id' => PermissionGroup::where('name', 'Country')->first()->id,
            ],
            [
                'name' => 'Country Update',
                'permission_group_id' => PermissionGroup::where('name', 'Country')->first()->id,
            ],
            [
                'name' => 'Country Destroy',
                'permission_group_id' => PermissionGroup::where('name', 'Country')->first()->id,
            ],
            [
                'name' => 'State Index',
                'permission_group_id' => PermissionGroup::where('name', 'State')->first()->id,
            ],
            [
                'name' => 'State Create',
                'permission_group_id' => PermissionGroup::where('name', 'State')->first()->id,
            ],
            [
                'name' => 'State Update',
                'permission_group_id' => PermissionGroup::where('name', 'State')->first()->id,
            ],
            [
                'name' => 'State Destroy',
                'permission_group_id' => PermissionGroup::where('name', 'State')->first()->id,
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
