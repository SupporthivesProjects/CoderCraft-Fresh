<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->integer('guest_id')->nullable();
            $table->longText('shipping_address')->nullable();
            $table->string('payment_type', 20)->nullable();
            $table->string('payment_status', 20)->default('unpaid');
            $table->longText('payment_details')->nullable();
            $table->double('grand_total', 8, 2)->nullable();
            $table->double('coupon_discount', 8, 2)->default(0.00);
            $table->mediumText('code')->nullable();
            $table->integer('date');
            $table->boolean('viewed')->default(false);
            $table->boolean('delivery_viewed')->default(false);
            $table->boolean('payment_status_viewed')->default(false);
            $table->integer('commission_calculated')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
