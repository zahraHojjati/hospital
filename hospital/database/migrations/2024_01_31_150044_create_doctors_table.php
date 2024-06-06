<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use \App\Traits\HasPermission;

    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('speciality_id')->constrained('specialities')->noActionOnDelete()->cascadeOnUpdate();
            $table->string('national_code');
            $table->string('medical_number')->unique();
            $table->string('mobile')->unique();
            $table->string('email')->nullable();
            $table->string('password');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
        $permissions = [
            'view doctors' => 'نمایش لیست پزشکان',
            'show doctors' => 'نمایش مشخصات پزشک',
            'create doctors' => 'ایجاد پزشک',
            'edit doctors' => 'ویرایش پزشک',
            'delete doctors' => 'حذف پزشک',
        ];

        $permissionNames = $this->createPermissions($permissions);

        //assign permissions to role
        $this->assignPermissions($permissionNames, 'admin');
    }


    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
