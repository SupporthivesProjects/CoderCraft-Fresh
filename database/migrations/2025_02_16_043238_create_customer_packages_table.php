<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerPackagesTable extends Migration
{
    public function up()
    {
        Schema::create('customer_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->double('amount', 28, 2)->nullable();
            $table->integer('product_upload')->nullable();
            $table->string('logo', 150)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_packages');
    }
}
