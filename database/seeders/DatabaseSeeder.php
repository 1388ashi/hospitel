<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ایجاد نقش "Super Admin" اگر وجود نداشت
        $role = Role::firstOrCreate(['name' => 'super_admin']);

        // اختصاص دادن مجوزها به نقش "Super Admin"
        $permissions = Permission::all();
        $role->syncPermissions($permissions);
    }
}
