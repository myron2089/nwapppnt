<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('user_events', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->integer('user_id')->unsigned();

            $table->integer('event_id')->unsigned();

            $table->integer('user_type_id')->unsigned();

            $table->foreign('user_id')

                ->references('id')

                ->on('users')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->foreign('event_id')

                ->references('id')

                ->on('events')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->foreign('user_type_id')

                ->references('id')

                ->on('user_types')

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

        Schema::dropIfExists('user_events');

    }
}
