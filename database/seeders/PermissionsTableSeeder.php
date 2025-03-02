<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => 18,
                'title' => 'category_access',
            ],
            [
                'id'    => 19,
                'title' => 'category_create',
            ],
            [
                'id'    => 20,
                'title' => 'category_edit',
            ],
            [
                'id'    => 21,
                'title' => 'category_delete',
            ],
            [
                'id'    => 22,
                'title' => 'designation_access',
            ],
            [
                'id'    => 23,
                'title' => 'designation_create',
            ],
            [
                'id'    => 24,
                'title' => 'designation_edit',
            ],
            [
                'id'    => 25,
                'title' => 'designation_delete',
            ],
            [
                'id'    => 26,
                'title' => 'company_access',
            ],
            [
                'id'    => 27,
                'title' => 'company_create',
            ],
            [
                'id'    => 28,
                'title' => 'company_edit',
            ],
            [
                'id'    => 29,
                'title' => 'company_delete',
            ],
            [
                'id'    => 30,
                'title' => 'client_access',
            ],
            [
                'id'    => 31,
                'title' => 'client_create',
            ],
            [
                'id'    => 32,
                'title' => 'client_edit',
            ],
            [
                'id'    => 33,
                'title' => 'client_delete',
            ],
            [
                'id'    => 34,
                'title' => 'task_access',
            ],
            [
                'id'    => 35,
                'title' => 'task_create',
            ],
            [
                'id'    => 36,
                'title' => 'task_edit',
            ],
            [
                'id'    => 37,
                'title' => 'task_delete',
            ],
            [
                'id'    => 38,
                'title' => 'today_task',
            ],
            [
                'id'    => 39,
                'title' => 'monthly_task',
            ],
            [
                'id'    => 40,
                'title' => 'pending_task',
            ],
            [
                'id'    => 41,
                'title' => 'completed_delete',
            ],
            [
                'id'    => 42,
                'title' => 'magazine_access',
            ],
            [
                'id'    => 43,
                'title' => 'magazine_create',
            ],
            [
                'id'    => 44,
                'title' => 'magazine_edit',
            ],
            [
                'id'    => 45,
                'title' => 'magazine_delete',
            ],
            [
                'id'    => 46,
                'title' => 'notice_access',
            ],
            [
                'id'    => 47,
                'title' => 'notice_create',
            ],
            [
                'id'    => 48,
                'title' => 'notice_edit',
            ],
            [
                'id'    => 49,
                'title' => 'notice_delete',
            ],
            
        ];

        Permission::insert($permissions);
    }
}
