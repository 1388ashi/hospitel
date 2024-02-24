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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->enum('pay_type',['cash','cheque']);
            $table->bigInteger('amount');
            $table->string('recipt',100);
            $table->boolean('status')->default(1);
            $table->timestamp('due_date')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger(column:'invoice_id');

            $table->foreign('invoice_id')
            ->references(columns:'id')
            ->on(table:'invoices')
            ->onDelete(action:'cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
