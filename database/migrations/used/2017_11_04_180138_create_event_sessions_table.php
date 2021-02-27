<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('event_sessions', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->integer('event_id')->unsigned();

            $table->integer('user_id')->unsigned();

            $table->integer('event_session_location_id')->unsigned();

            $table->integer('event_session_type_id')->unsigned();

            $table->string('eventSessionTitle');

            $table->text('eventSessionDescription')->nullable();

            $table->dateTime('eventSessionStart');

            $table->dateTime('eventSessionFinish');

            $table->foreign('event_id')

                ->references('id')

                ->on('events')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->foreign('user_id')

                ->references('id')

                ->on('users')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->foreign('event_session_location_id')

                ->references('id')

                ->on('event_session_locations')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->foreign('event_session_type_id')

                ->references('id')

                ->on('event_session_types')

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

        Schema::dropIfExists('event_sessions');

    }
}
