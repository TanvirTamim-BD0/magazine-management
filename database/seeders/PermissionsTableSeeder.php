<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            ['title' => 'user_management_access'],
            ['title' => 'permission_create'],
            ['title' => 'permission_edit'],
            ['title' => 'permission_show'],
            ['title' => 'permission_delete'],
            ['title' => 'permission_access'],
            ['title' => 'role_create'],
            ['title' => 'role_edit'],
            ['title' => 'role_show'],
            ['title' => 'role_delete'],
            ['title' => 'role_access'],
            ['title' => 'user_create'],
            ['title' => 'user_edit'],
            ['title' => 'user_show'],
            ['title' => 'user_delete'],
            ['title' => 'user_access'],
            ['title' => 'user_active_inactive'],
            ['title' => 'profile_password_edit'],
            ['title' => 'category_access'],
            ['title' => 'category_create'],
            ['title' => 'category_edit'],
            ['title' => 'category_delete'],
            ['title' => 'designation_access'],
            ['title' => 'designation_create'],
            ['title' => 'designation_edit'],
            ['title' => 'designation_delete'],
            ['title' => 'company_access'],
            ['title' => 'company_create'],
            ['title' => 'company_edit'],
            ['title' => 'company_delete'],
            ['title' => 'area_access'],
            ['title' => 'area_create'],
            ['title' => 'area_edit'],
            ['title' => 'area_delete'],
            ['title' => 'client_access'],
            ['title' => 'client_create'],
            ['title' => 'client_edit'],
            ['title' => 'client_delete'],
            ['title' => 'magazine_management_access'],
            ['title' => 'task_access'],
            ['title' => 'task_create'],
            ['title' => 'task_edit'],
            ['title' => 'task_delete'],
            ['title' => 'today_task'],
            ['title' => 'task_admin_comment'],
            ['title' => 'monthly_task'],
            ['title' => 'pending_task'],
            ['title' => 'completed_task'],
            ['title' => 'magazine_access'],
            ['title' => 'magazine_create'],
            ['title' => 'magazine_edit'],
            ['title' => 'magazine_delete'],
            ['title' => 'magazine_send'],
            ['title' => 'notice_access'],
            ['title' => 'notice_create'],
            ['title' => 'notice_edit'],
            ['title' => 'notice_delete'],
            ['title' => 'task_assign_access'],
            ['title' => 'task_assign_create'],
            ['title' => 'task_assign_edit'],
            ['title' => 'task_assign_delete'],
        ];
        Permission::insert($permissions);
    }
}
