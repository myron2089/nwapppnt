<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventWebResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('event_web_resources', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->integer('event_id')->unsigned();

            $table->string('eventWebResourceName');

            $table->text('eventWebResourceValue');

            $table->integer('eventWebResourcePosition')->unsigned();

            $table->string('eventWebResourceTag');

            $table->string('eventWebResourcePath');

            $table->foreign('event_id')

                ->references('id')

                ->on('events')

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

        Schema::dropIfExists('event_web_resources');

    }
}
