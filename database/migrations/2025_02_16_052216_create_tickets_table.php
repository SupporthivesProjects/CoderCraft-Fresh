<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('code');
            $table->foreignId('user_id')->constrained();
            $table->string('subject');
            $table->longText('details')->nullable();
            $table->longText('files')->nullable();
            $table->string('status', 10)->default('pending');
            $table->boolean('viewed')->default(false);
            $table->boolean('client_viewed')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
