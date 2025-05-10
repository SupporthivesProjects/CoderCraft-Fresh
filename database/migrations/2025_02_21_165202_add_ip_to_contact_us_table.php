<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIpToContactUsTable extends Migration
{
    public function up()
    {
        Schema::table('contactus', function (Blueprint $table) {
            $table->string('ip_address')->after('attachment');
            $table->timestamp('submitted_at')->after('ip_address');
        });
    }

    public function down()
    {
        Schema::table('contactus', function (Blueprint $table) {
            $table->dropColumn(['ip_address', 'submitted_at']);
        });
    }
}
