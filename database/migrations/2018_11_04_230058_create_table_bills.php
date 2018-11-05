<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_customer')->unsigned();
            // $table->dropForeign('bills_id_customer_foreign');
            $table->foreign('id_customer')->references('id')->on('customers')->onDelete('cascade');
            $table->date('date_order');
            $table->double('total');
            $table->integer('id_payment')->unsigned();
            // $table->dropForeign('bills_id_payment_foreign');
            $table->foreign('id_payment')->references('id')->on('payment_methods')->onDelet('cascade');
            $table->string('note');
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
        Schema::dropIfExists('bills');
    }
}
