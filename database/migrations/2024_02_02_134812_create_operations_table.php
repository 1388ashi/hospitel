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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->bigInteger('price');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
        $permissions = [
            'view operations' => 'نمایش عمل ها',
            'create operations' => 'ایجاد عمل ',
            'edit operations' => 'ویرایش عمل ها',
            'delete operations' => 'حذف عمل ها',
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
        Schema::dropIfExists('operations');
    }
};
