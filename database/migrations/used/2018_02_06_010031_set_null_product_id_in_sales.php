<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetNullProductIdInSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {

            $table->dropForeign('sales_product_id_foreign');
            $table->dropColumn('product_id');

        });

        Schema::table('sales', function (Blueprint $table) {

            $table->integer('product_id')->unsigned()->nullable();

            $table->foreign('product_id')

                ->references('id')

                ->on('products')

                ->onDelete('cascade')

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
        Schema::table('sales', function (Blueprint $table) {

            $table->dropForeign('sales_product_id_foreign');
            $table->dropColumn('product_id');

        });
    }
}
