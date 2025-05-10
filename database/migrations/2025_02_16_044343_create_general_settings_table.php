<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('frontend_color')->default('default');
            $table->string('logo')->nullable();
            $table->string('admin_logo')->nullable();
            $table->string('admin_login_background')->nullable();
            $table->string('admin_login_sidebar')->nullable();
            $table->string('favicon')->nullable();
            $table->string('site_name')->nullable();
            $table->string('address', 1000)->nullable();
            $table->mediumText('description');
            $table->string('phone', 100)->nullable();
            $table->string('email')->nullable();
            $table->string('facebook', 1000)->nullable();
            $table->string('instagram', 1000)->nullable();
            $table->string('twitter', 1000)->nullable();
            $table->string('youtube', 1000)->nullable();
            $table->string('google_plus', 1000)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
}
