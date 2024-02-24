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
        Schema::create('doctor_surgery', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Doctor::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Surgery::class)->constrained()->cascadeOnDelete();
            $table->foreignId('doctor_role_id');
            $table->foreignId('invoice_id')->nullable();
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
