<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLastBillingAddressTable extends Migration
{
    public function up()
    {
        Schema::create('last_billing_address', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('email', 100);
            $table->string('name', 50);
            $table->string('lname', 50);
            $table->string('address', 150);
            $table->string('addressL2', 150);
            $table->string('city', 50);
            $table->string('postal_code', 20);
            $table->string('country', 50);
            $table->string('stateProvince', 10);
            $table->date('dob');
            $table->string('phone', 20);
            $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('last_billing_address');
    }
}
