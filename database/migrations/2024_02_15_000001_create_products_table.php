<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('added_by', 6)->default('admin');
            $table->integer('user_id');
            $table->string('subscription')->nullable();
            $table->integer('category_id');
            $table->integer('subcategory_id')->nullable();
            $table->integer('subsubcategory_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('photos', 2000)->nullable();
            $table->string('thumbnail_img', 100)->nullable();
            $table->string('featured_img', 100)->nullable();
            $table->string('flash_deal_img', 100)->nullable();
            $table->string('video_provider', 20)->nullable();
            $table->string('video_link', 100)->nullable();
            $table->mediumText('tags')->nullable();
            $table->longText('description')->nullable();
            $table->double('unit_price', 30, 2);
            $table->double('purchase_price', 8, 2);
            $table->integer('variant_product')->default(0);
            $table->string('attributes', 1000)->default('[]');
            $table->mediumText('choice_options')->nullable();
            $table->mediumText('colors')->nullable();
            $table->text('variations')->nullable();
            $table->integer('todays_deal')->default(0);
            $table->integer('published')->default(1);
            $table->integer('featured')->default(0);
            $table->integer('current_stock')->default(0);
            $table->string('unit', 20)->nullable();
            $table->double('discount', 8, 2)->nullable();
            $table->string('discount_type', 10)->nullable();
            $table->double('tax', 8, 2)->nullable();
            $table->string('tax_type', 10)->nullable();
            $table->string('shipping_type', 20)->default('flat_rate');
            $table->double('shipping_cost', 8, 2)->default(0.00);
            $table->integer('num_of_sale')->default(0);
            $table->mediumText('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('meta_img', 255)->nullable();
            $table->string('pdf', 255)->nullable();
            $table->mediumText('slug');
            $table->double('rating', 8, 2)->default(0.00);
            $table->string('barcode', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
