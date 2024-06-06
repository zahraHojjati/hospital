<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use \App\Traits\HasPermission;

    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('group');
            $table->string('label');
            $table->string('name');
            $table->enum('type',['text','image','textarea']);
            $table->text('value');
            $table->timestamps();
        });
        $permissions = [
            'view settings' => 'نمایش تنظیمات',
            'create settings' => 'ایجاد تنظیمات',
            'edit settings' => 'ویرایش تنظیمات',
            'delete settings' => 'حذف تنظیمات',
        ];

        $permissionNames = $this->createPermissions($permissions);

        //assign permissions to role
        $this->assignPermissions($permissionNames, 'admin');
    }


    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
