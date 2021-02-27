<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteCascadeUserEventInScanUserProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scan_user_products', function (Blueprint $table) {

            $table->dropForeign('scan_user_products_scanusersource_foreign');
            $table->dropColumn('scanUserSource');

            $table->dropForeign('scan_user_products_scanproductdestination_foreign');
            $table->dropColumn('scanProductDestination');


        });

        Schema::table('scan_user_products', function (Blueprint $table) {

            $table->integer('scanUserSource')->unsigned();

            $table->foreign('scanUserSource')

                ->references('id')

                ->on('user_events')

                ->onDelete('cascade')

                ->onUpdate('cascade');

            $table->integer('scanProductDestination')->unsigned();

            $table->foreign('scanProductDestination')

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
        Schema::table('scan_user_products', function (Blueprint $table) {

            $table->dropForeign('scan_user_products_scanusersource_foreign');
            $table->dropColumn('scanUserSource');

            $table->dropForeign('scan_user_products_scanproductdestination_foreign');
            $table->dropColumn('scanProductDestination');

        });
    }
}
