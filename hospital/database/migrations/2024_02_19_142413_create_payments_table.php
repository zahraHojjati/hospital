<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use \App\Traits\HasPermission;

    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invoice_id')->constrained('invoices')->noActionOnDelete()->cascadeOnUpdate();
            $table->bigInteger('amount');
            $table->enum('pay_type',['cash','cheque']);
            $table->date('due_date');
            $table->string('receipt');
            $table->text('description');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
        $permissions = [
            'index payments' => 'لیست پرداختی ها',
            'view payments' => 'نمایش جزئیات پرداخت',
            'create payments' => 'ایجاد پرداخت',
            'edit payments' => 'ویرایش پرداخت',
            'delete payments' => 'حذف پرداخت',
        ];

        $permissionNames = $this->createPermissions($permissions);

        //assign permissions to role
        $this->assignPermissions($permissionNames, 'admin');
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
