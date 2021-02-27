<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('events', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->string('eventName');

            $table->text('eventDescription')->nullable();

            $table->datetime('eventStart');

            $table->datetime('eventFinish');

            $table->integer('event_location_id')->unsigned();

            $table->integer('event_status_id')->unsigned();

            $table->integer('event_type_id')->unsigned();

            $table->decimal('eventPrice',10,2);

            $table->foreign('event_location_id')

                ->references('id')

                ->on('event_locations')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->foreign('event_status_id')

                ->references('id')

                ->on('event_statuses')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->foreign('event_type_id')

                ->references('id')

                ->on('event_types')

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

        Schema::dropIfExists('events');

    }
}
