<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use \App\Traits\HasPermission;

    public function up(): void
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->enum('type',['basic','supplementary']);
            $table->tinyInteger('discount');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
        $permissions = [
            'view insurances' => 'نمایش بیمه ها',
            'create insurances' => 'ایجاد بیمه',
            'edit insurances' => 'ویرایش بیمه',
            'delete insurances' => 'حذف بیمه',
        ];

        $permissionNames = $this->createPermissions($permissions);

        //assign permissions to role
        $this->assignPermissions($permissionNames, 'admin');
    }

    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};
