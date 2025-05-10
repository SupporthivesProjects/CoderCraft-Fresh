<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatewayHistoryTable extends Migration
{
    public function up()
    {
        Schema::create('gateway_history', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('TransactionID');
            $table->string('MerchantRef');
            $table->smallInteger('TransTypeID');
            $table->char('Currency', 3);
            $table->bigInteger('Amount');
            $table->string('BusinessCase', 50);
            $table->string('Descriptor', 100);
            $table->string('Bank', 50);
            $table->integer('ResponseCode');
            $table->string('ResponseDescription');
            $table->string('BankCode', 50);
            $table->string('BankDescription');
            $table->string('Signature');
            $table->timestamp('time_stamp')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gateway_history');
    }
}
