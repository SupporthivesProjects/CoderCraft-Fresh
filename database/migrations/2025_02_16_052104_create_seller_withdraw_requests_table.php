<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerWithdrawRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('seller_withdraw_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->double('amount', 8, 2)->nullable();
            $table->longText('message')->nullable();
            $table->boolean('status')->nullable();
            $table->boolean('viewed')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seller_withdraw_requests');
    }
}
