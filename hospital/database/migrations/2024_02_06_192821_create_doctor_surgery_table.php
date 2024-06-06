<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Doctor;
use App\Models\Surgery;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('doctor_surgery', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Doctor::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Surgery::class)->constrained()->cascadeOnDelete();
            $table->foreignId('doctor_role_id');
            $table->bigInteger('invoice_id');
            $table->bigInteger('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_surgery');
    }
};
