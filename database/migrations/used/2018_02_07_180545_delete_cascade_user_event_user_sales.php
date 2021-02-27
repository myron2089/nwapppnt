<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteCascadeUserEventUserSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scan_user_sales', function (Blueprint $table) {

            $table->dropForeign('scan_user_sales_scanusersource_foreign');
            $table->dropColumn('scanUserSource');

            $table->dropForeign('scan_user_sales_scansaledestination_foreign');
            $table->dropColumn('scanSaleDestination');


        });

        Schema::table('scan_user_sales', function (Blueprint $table) {

            $table->integer('scanUserSource')->unsigned();

            $table->foreign('scanUserSource')

                ->references('id')

                ->on('user_events')

                ->onDelete('cascade')

                ->onUpdate('cascade');

            $table->integer('scanSaleDestination')->unsigned();

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

            $table->dropForeign('scan_user_sales_scanusersource_foreign');
            $table->dropColumn('scanUserSource');

            $table->dropForeign('scan_user_sales_scansaledestination_foreign');
            $table->dropColumn('scanSaleDestination');

        });
    }
}
