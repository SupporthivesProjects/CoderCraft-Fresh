<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('seller_id')->nullable()->constrained('sellers');
            $table->foreignId('product_id')->constrained('products');
            $table->longText('variation')->nullable();
            $table->double('price', 8, 2)->nullable();
            $table->double('tax', 8, 2)->default(0.00);
            $table->double('shipping_cost', 8, 2)->default(0.00);
            $table->integer('quantity')->nullable();
            $table->string('translation_file', 300)->nullable();
            $table->string('from_lang', 100)->nullable();
            $table->string('to_lang', 100)->nullable();
            $table->string('service_no_of_pages', 100)->nullable();
            $table->integer('service_no_of_words')->nullable();
            $table->string('delivery_datetime', 100)->nullable();
            $table->string('message', 1000)->nullable();
            $table->string('payment_status', 10)->default('unpaid');
            $table->string('delivery_status', 20)->default('pending');
            $table->string('shipping_type')->nullable();
            $table->foreignId('pickup_point_id')->nullable()->constrained('pickup_points');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
