<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEventFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('user_event_forms', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->integer('form_id')->unsigned();

            $table->integer('user_event_id')->unsigned();

            $table->softDeletes();

            $table->timestamps();

            $table->foreign('form_id')

                ->references('id')

                ->on('forms')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->foreign('user_event_id')

                ->references('id')

                ->on('user_events')

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
        Schema::dropIfExists('user_event_forms');
    }
}
