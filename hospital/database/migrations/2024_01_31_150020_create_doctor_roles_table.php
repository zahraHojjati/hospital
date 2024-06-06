<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    use \App\Traits\HasPermission;

    public function up(): void
    {
        Schema::create('doctor_roles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->boolean('required')->default(0);
            $table->boolean('status')->default(1);
            $table->unsignedTinyInteger('quota');//0 to 100
            $table->timestamps();
        });

        $permissions = [
            'view doctor_roles' => 'نمایش  نقش ها',
            'create doctor_roles' => 'ایجاد نقش',
            'edit doctor_roles' => 'ویرایش نقش',
            'delete doctor_roles' => 'حذف نقش',
        ];

        $permissionNames = $this->createPermissions($permissions);

        //assign permissions to role
        $this->assignPermissions($permissionNames, 'admin');
    }


    public function down(): void
    {
        Schema::dropIfExists('doctor_roles');
    }
};
