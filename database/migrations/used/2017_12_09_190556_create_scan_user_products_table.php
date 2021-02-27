<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScanUserProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scan_user_products', function (Blueprint $table) {

            $table->integer('id')->integer();

            $table->primary('id');

            $table->integer('scanUserSource')->unsigned();

            $table->integer('scanProductDestination')->unsigned();

            $table->foreign('scanUserSource')

                ->references('id')

                ->on('user_events')

                ->onDelete('restrict')

                ->onUpdate('restrict');

            $table->foreign('scanProductDestination')

                ->references('id')

                ->on('products')

                ->onDelete('restrict')

                ->onUpdate('restrict');

            $table->softDeletes();

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
        Schema::dropIfExists('scan_user_products');
    }
}
