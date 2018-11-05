<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('name_title');
            $table->integer('id_type')->unsigned();
            // $table->dropForeign('products_id_type_foreign');
            $table->foreign('id_type')->references('id')->on('type_products')->onDelete('cascade');
            $table->text('description');
            $table->bigInteger('unit_price');
            $table->bigInteger('promotion_price');
            $table->string('image');
            $table->string('product_code');
            $table->string('sell_quantity')->default(0);
            $table->integer('id_manufactory')->unsigned();
            // $table->dropForeign('products_id_manufactory_foreign');
            $table->foreign('id_manufactory')->references('id')->on('manufactories')->onDelete('cascade');
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
