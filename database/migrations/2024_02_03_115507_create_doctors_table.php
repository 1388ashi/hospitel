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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('national_code')->nullable();
            $table->string('medical_number')->nullable()->unique();
            $table->string('mobile',20)->unique();
            $table->string('password');
            $table->string('email')->nullable();
            $table->boolean('status')->default(true);
            $table->foreignId('specialties_id')->constrained('specialties')->cascadeOnDelete();
            $table->timestamps();
        });
        $permissions = [
            'view doctors' => 'نمایش دکتر ها',
            'create doctors' => 'ایجاد دکتر ',
            'edit doctors' => 'ویرایش دکتر ها',
            'delete doctors' => 'حذف دکتر ها',
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
        Schema::dropIfExists('doctors');
    }
};
