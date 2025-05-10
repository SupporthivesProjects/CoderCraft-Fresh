<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlashDealProductsTable extends Migration
{
    public function up()
    {
        Schema::create('flash_deal_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('flash_deal_id');
            $table->unsignedBigInteger('product_id');
            $table->double('discount', 8, 2)->default(0.00);
            $table->string('discount_type', 20)->nullable();
            $table->timestamps();

            $table->foreign('flash_deal_id')->references('id')->on('flash_deals');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    public function down()
    {
        Schema::dropIfExists('flash_deal_products');
    }
}
