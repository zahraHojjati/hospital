<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    use \App\Traits\HasPermission;

    public function up(): void
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('price');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        $permissions = [
            'view operations' => 'نمایش عمل ها',
            'create operations' => 'ایجاد عمل',
            'edit operations' => 'ویرایش عمل',
            'delete operations' => 'حذف عمل',
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
