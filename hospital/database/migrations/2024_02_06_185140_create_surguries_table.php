<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use \App\Traits\HasPermission;

    public function up(): void
    {
        Schema::create('surgeries', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->string('patient_national_code');
            $table->bigInteger('basic_insurance_id')->constrained('insurances')->noActionOnDelete()->cascadeOnUpdate();
            $table->bigInteger('supp_insurance_id')->constrained('insurances')->noActionOnDelete()->cascadeOnUpdate();
            $table->integer('document_number')->unique();
            $table->text('description');
            $table->date('surgeried_at');
            $table->date('released_at');
            $table->timestamps();
        });
        $permissions = [
            'index surgeries' => 'لیست جراحی ها',
            'view surgeries' => 'نمایش جزئیات جراحی',
            'create surgeries' => 'ایجاد جراحی',
            'edit surgeries' => 'ویرایش جراحی',
            'delete surgeries' => 'حذف جراحی',
        ];

        $permissionNames = $this->createPermissions($permissions);

        //assign permissions to role
        $this->assignPermissions($permissionNames, 'admin');
    }


    public function down(): void
    {
        Schema::dropIfExists('surgeries');
    }
};
