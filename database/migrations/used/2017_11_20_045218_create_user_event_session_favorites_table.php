<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEventSessionFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_event_session_favorites', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->integer('user_event_id')->unsigned();

            $table->integer('event_session_id')->unsigned();

            $table->foreign('user_event_id')

                ->references('id')

                ->on('user_events')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->foreign('event_session_id')

                ->references('id')

                ->on('event_sessions')

                ->onDelete('restrict')

                ->onUpdate('cascade');

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
        Schema::dropIfExists('user_event_session_favorites');
    }
}
