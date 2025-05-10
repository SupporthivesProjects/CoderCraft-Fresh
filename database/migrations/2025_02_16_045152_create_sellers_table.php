<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->boolean('verification_status')->default(false);
            $table->longText('verification_info')->nullable();
            $table->boolean('cash_on_delivery_status')->default(false);
            $table->double('admin_to_pay', 8, 2)->default(0.00);
            $table->string('bank_name')->nullable();
            $table->string('bank_acc_name', 200)->nullable();
            $table->string('bank_acc_no', 50)->nullable();
            $table->integer('bank_routing_no')->nullable();
            $table->boolean('bank_payment_status')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
