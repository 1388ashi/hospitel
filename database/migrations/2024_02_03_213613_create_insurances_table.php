<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use \App\Traits\HasPermission;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->enum('type',['basic','supplementary']);
            $table->tinyinteger('discount');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
        $permissions = [
            'view insurances' => 'نمایش بیمه ها',
            'create insurances' => 'ایجاد بیمه ',
            'edit insurances' => 'ویرایش بیمه ها',
            'delete insurances' => 'حذف بیمه ها',
        ];

        $permissionNames = $this->createPermissions($permissions);

        //assign permissions to role
        $this->assignPermissions($permissionNames, 'admin');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};
