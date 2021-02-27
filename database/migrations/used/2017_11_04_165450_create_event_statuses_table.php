<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('event_statuses', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->string('eventStatusName');

            $table->text('eventStatusDescription');

            $table->integer('eventStatusSequence')->unique();

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

        Schema::dropIfExists('event_statuses');

    }
}
