<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctor_doctor_role', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('doctor_id')->constrained('doctors')->noActionOnDelete()->cascadeOnUpdate();
            $table->bigInteger('doctor_role_id')->constrained('doctor_roles')->noActionOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_doctor_role');
    }
};
