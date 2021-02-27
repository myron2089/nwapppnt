<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetToNullBrandIdOnProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {

            $table->dropForeign('products_brand_id_foreign');
            $table->dropColumn('brand_id');

        });

        Schema::table('products', function (Blueprint $table) {

            $table->integer('brand_id')->unsigned()->nullable();

            $table->foreign('brand_id')

                ->references('id')

                ->on('brands')

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
        Schema::table('brands', function (Blueprint $table) {

            $table->dropForeign('products_brand_id_foreign');
            $table->dropColumn('brand_id');

        });
    }
}
