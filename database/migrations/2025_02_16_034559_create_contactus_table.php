<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactusTable extends Migration
{
    public function up()
    {
        Schema::create('contactus', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 100);
            $table->string('email', 100);
            $table->string('phone', 20)->nullable();
            $table->string('address', 300)->nullable();
            $table->string('message', 500)->nullable();
            $table->string('native_lang', 50)->nullable();
            $table->string('pairs_lang', 100)->nullable();
            $table->string('rate_per', 50)->nullable();
            $table->string('lang_pairs_rate', 100)->nullable();
            $table->string('medium', 20)->nullable();
            $table->string('selected_service', 100)->nullable();
            $table->text('attachment')->nullable();
            $table->string('from_page', 20);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contactus');
    }
}
