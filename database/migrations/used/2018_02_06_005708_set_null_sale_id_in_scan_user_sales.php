<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetNullSaleIdInScanUserSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scan_user_sales', function (Blueprint $table) {

            $table->dropForeign('scan_user_sales_scansaledestination_foreign');
            $table->dropColumn('scanSaleDestination');

        });

        Schema::table('scan_user_sales', function (Blueprint $table) {

            $table->integer('scanSaleDestination')->unsigned()->nullable();

            $table->foreign('scanSaleDestination')

                ->references('id')

                ->on('sales')

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
        Schema::table('scan_user_sales', function (Blueprint $table) {

            $table->dropForeign('scan_user_sales_scansaledestination_foreign');
            $table->dropColumn('scanSaleDestination');

        });
    }
}
