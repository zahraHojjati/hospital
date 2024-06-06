<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    use \App\Traits\HasPermission;

    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('doctor_id')->constrained('doctors')->noActionOnDelete()->cascadeOnUpdate();;
            $table->bigInteger('amount');
            $table->text('description');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });

        $permissions = [
            'index invoices' => 'لیست صورت حساب ها',
            'view invoices' => 'نمایش جزئیات صورت حساب',
            'create invoices' => 'ایجاد صورت حساب',
            'edit invoices' => 'ویرایش صورت حساب',
            'delete invoices' => 'حذف صورت حساب',
        ];

        $permissionNames = $this->createPermissions($permissions);

        //assign permissions to role
        $this->assignPermissions($permissionNames, 'admin');
    }


    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
