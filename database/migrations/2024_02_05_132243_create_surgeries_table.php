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
        Schema::create('surgeries', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name',100);
            $table->string('patient_national_code',20);
            $table->foreignId('basic_insurance_id')->nullable()->constrained('insurances')->noActionOnDelete();
            $table->foreignId('supp_insurance_id')->nullable()->constrained('insurances')->noActionOnDelete();
            $table->integer('document_number')->unique();
            $table->text('description')->nullable();
            $table->timestamp('surgeried_at');
            $table->timestamp('released_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
        $permissions = [
            'view surguries' => 'نمایش جراحی ها',
            'create surguries' => 'ایجاد جراحی ',
            'edit surguries' => 'ویرایش جراحی ها',
            'delete surguries' => 'حذف جراحی ها',
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
        Schema::dropIfExists('surguries');
    }
};
