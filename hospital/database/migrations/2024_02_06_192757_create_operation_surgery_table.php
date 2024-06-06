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
        Schema::create('operation_surgery', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('operation_id')->constrained('operations')->noActionOnDelete()->cascadeOnUpdate();
            $table->bigInteger('surgery_id')->constrained('surgeries')->noActionOnDelete()->cascadeOnUpdate();
            $table->bigInteger('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_surgery');
    }
};
