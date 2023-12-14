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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->index();
            $table->unsignedBigInteger('customer_id')->index();
            $table->unsignedBigInteger('laundry_staff_id')->index();
            $table->unsignedBigInteger('laundry_service_id')->index();
            $table->string('order_code');
            $table->date('order_date');
            $table->integer('amount')->nullable();
            $table->float('total')->nullable();
            $table->boolean('payment_status')->default(0);
            $table->dateTime('payment_at')->nullable();
            $table->string('order_status')->nullable();
            $table->dateTime('taken_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
