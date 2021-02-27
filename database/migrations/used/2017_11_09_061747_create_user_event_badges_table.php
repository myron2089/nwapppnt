<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEventBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_event_badges', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->integer('user_event_id')->unsigned();

            $table->string('userFirstName');

            $table->string('userLastName');

            $table->string('userTitle');

            $table->string('userEmail');

            $table->string('userCompanyName');

            $table->text('userAddress');

            $table->bigInteger('userPhoneNumber');

            $table->foreign('user_event_id')

                ->references('id')

                ->on('user_events')

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

        Schema::dropIfExists('user_event_badges');

    }
}
