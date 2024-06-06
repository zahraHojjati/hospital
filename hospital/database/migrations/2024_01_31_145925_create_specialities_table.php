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
        Schema::create('specialities', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        $permissions = [
            'view specialities' => 'نمایش تخصص ها',
            'create specialities' => 'ایجاد تخصص',
            'edit specialities' => 'ویرایش تخصص',
            'delete specialities' => 'حذف تخصص',
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
        Schema::dropIfExists('specialities');
    }
};
