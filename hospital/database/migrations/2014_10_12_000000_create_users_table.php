<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

return new class extends Migration {

    use \App\Traits\HasPermission;

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile')->unique();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('status')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
        $user = User::query()->create([
            'name' => 'Super Admin',
            'mobile' => '09117508268',
            'password' => bcrypt('123456')
        ]);

        //***** Create roles only in users migration **
        $roles = [
            'super_admin' => 'مدیر ارشد',
            'admin' => 'مدیر'
        ];

        foreach ($roles as $name => $label) {
            $role = new Role();
            $role->label = $label;
            $role->name = $name;
            $role->save();
        }

        $permissions = [
            'view dashboard list operations' => ' نمایش لیست عمل ها در داشبورد',
            'view dashboard state'=> 'نمایش آمارها در داشبورد',
            'view dashboard Invoices' => 'نمایش لیست صورتحساب ها در داشبورد',
            'view users' => 'نمایش کاربران',
            'create users' => 'ایجاد کاربران',
            'edit users' => 'ویرایش کاربران',
            'حذف users' => 'حذف کاربران',
        ];

        $permissionNames = $this->createPermissions($permissions);

//        assign permissions to role
        $this->assignPermissions($permissionNames, 'admin');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
