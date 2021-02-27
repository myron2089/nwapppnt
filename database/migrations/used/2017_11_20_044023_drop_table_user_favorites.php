<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTableUserFavorites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('user_favorites');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::create('user_favorites', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->integer('user_event_id')->unsigned();

            $table->integer('item_id')->unsigned();

            $table->foreign('user_event_id')

                ->references('id')

                ->on('user_events')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->softDeletes();

            $table->timestamps();

        });

    }
}
