<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    use \App\Traits\HasPermission;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctor_roles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
        $permissions = [
            'view role_doctors' => 'نمایش دکتر ها',
            'create role_doctors' => 'ایجاد دکتر ',
            'edit role_doctors' => 'ویرایش دکتر ها',
            'delete role_doctors' => 'حذف دکتر ها',
        ];

        $permissionNames = $this->createPermissions($permissions);

        //assign permissions to role
        $this->assignPermissions($permissionNames,'super_admin');
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_roles');
    }
};
