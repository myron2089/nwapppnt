<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCurrencyToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {


            $table->integer('payment_currency_id')->unsigned();

            $table->foreign('payment_currency_id')

                ->references('id')

                ->on('payment_currencies')

                ->onDelete('restrict')

                ->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('products', function (Blueprint $table) {

            $table->dropColumn('payment_currency_id');


        });

    }
}
