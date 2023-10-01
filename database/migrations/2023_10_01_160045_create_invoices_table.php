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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->integer('job_id')->nullable(false);
            $table->integer('customer_id')->nullable(false);
            $table->string('product_name')->nullable(false);
            $table->text('description')->nullable(false);
            $table->tinyInteger('quantity')->nullable(false);
            $table->string('currency')->nullable(false);
            $table->string('total_amount')->nullable(false);
            $table->string('payment_method')->nullablse(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
