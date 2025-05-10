<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerProductsTable extends Migration
{
    public function up()
    {
        Schema::create('customer_products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->boolean('published')->default(false);
            $table->boolean('status')->default(false);
            $table->string('added_by', 50)->nullable();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('category_id')->nullable()->constrained();
            $table->foreignId('subcategory_id')->nullable()->constrained('sub_categories');
            $table->foreignId('subsubcategory_id')->nullable()->constrained('sub_sub_categories');
            $table->string('brand_id');
            $table->string('photos')->nullable();
            $table->string('thumbnail_img', 150)->nullable();
            $table->string('conditon', 50)->nullable();
            $table->text('location')->nullable();
            $table->string('video_provider', 100)->nullable();
            $table->string('video_link', 200)->nullable();
            $table->string('unit', 200)->nullable();
            $table->string('tags')->nullable();
            $table->mediumText('description')->nullable();
            $table->double('unit_price', 28, 2)->default(0.00);
            $table->string('meta_title', 200)->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->string('meta_img', 150)->nullable();
            $table->string('pdf', 200)->nullable();
            $table->string('slug', 200)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_products');
    }
}
