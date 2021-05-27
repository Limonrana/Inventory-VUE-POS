<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->nullable();
            $table->string('sub_title')->nullable();
            $table->text('product_description')->nullable();
            $table->string('product_code')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->string('root')->nullable();
            $table->string('brand')->nullable();
            $table->string('buying_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('discount')->nullable();
            $table->string('buying_date')->nullable();
            $table->string('product_quantity')->nullable();
            $table->string('cpu')->nullable();
            $table->string('color')->nullable();
            $table->string('ram')->nullable();
            $table->string('rom')->nullable();
            $table->string('display_size')->nullable();
            $table->string('photo')->nullable();
            $table->string('slug')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
