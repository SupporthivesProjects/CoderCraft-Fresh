<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('seo_settings', function (Blueprint $table) {
            $table->id();
            $table->string('keyword');
            $table->string('author');
            $table->integer('revisit');
            $table->string('sitemap_link');
            $table->longText('description');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seo_settings');
    }
}
