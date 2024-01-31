<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label');
            $table->string('mobile',12)->unique();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

            $user = \App\Models\User::query()->create([
                'name' => 'Super Admin',
                'label' => 'مدیر کل',
                'mobile' => '09112702509',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123456'),
            ]);
        //create roles
        $superAdmin = Role::create([
            'name' => 'super_admin',
            'label' => 'مدیر ارشد'
        ]);
        $admin = Role::create([
            'name' => 'admin',
            'label' => 'مدیر'
        ]);

        //Assign super_admin role to user
        $user->assignRole($superAdmin);

        //generate permissions
        $viewDashboardListOperations = Permission::create([
            'name' => 'view dashboard list operations',
            'label' => 'نمایش لیست عمل ها در داشبورد'
        ]);
        $viewDashboardStats = Permission::create([
            'name' => 'view dashboard stats',
            'label' => 'نمایش آمارها در داشبورد'
        ]);
        $viewDashboardInvoices = Permission::create([
            'name' => 'view dashboard invoices',
            'label' => 'نمایش لیست صورتحساب ها در داشبورد'
        ]);


        $viewPermission = Permission::create([
            'name' => 'view users',
            'label' => 'نمایش کاربران'
        ]);
        $createPermission = Permission::create([
            'name' => 'create users',
            'label' => 'ایجاد کاربران'
        ]);
        $updatePermission = Permission::create([
            'name' => 'update users',
            'label' => 'ویرایش کاربران'
        ]);
        $deletePermission = Permission::create([
            'name' => 'delete users',
            'label' => 'حذف کاربران'
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};