<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use \App\Traits\HasPermission;

    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('body');
            $table->timestamp('viewed_at')->nullable();
            $table->timestamps();
        });
        $permissions = [
            'view notifications' => 'لیست  اعلان ها',
            'show notifications' => 'نمایش اعلان',
        ];

        $permissionNames = $this->createPermissions($permissions);

        //assign permissions to role
        $this->assignPermissions($permissionNames, 'admin');
    }



    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
