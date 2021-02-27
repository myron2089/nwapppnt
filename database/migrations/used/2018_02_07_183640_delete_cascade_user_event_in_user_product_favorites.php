<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteCascadeUserEventInUserProductFavorites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_product_favorites', function (Blueprint $table) {

            $table->dropForeign('user_product_favorites_user_event_id_foreign');
            $table->dropColumn('user_event_id');

            $table->dropForeign('user_product_favorites_product_id_foreign');
            $table->dropColumn('product_id');


        });

        Schema::table('user_product_favorites', function (Blueprint $table) {

            $table->integer('user_event_id')->unsigned();

            $table->foreign('user_event_id')

                ->references('id')

                ->on('user_events')

                ->onDelete('cascade')

                ->onUpdate('cascade');

            $table->integer('product_id')->unsigned();

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
        Schema::table('user_product_favorites', function (Blueprint $table) {

            $table->dropForeign('user_product_favorites_user_event_id_foreign');
            $table->dropColumn('user_event_id');

            $table->dropForeign('user_product_favorites_product_id_foreign  ');
            $table->dropColumn('product_id');

        });
    }
}
