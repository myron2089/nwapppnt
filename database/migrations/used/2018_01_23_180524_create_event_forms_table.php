<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_forms', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->primary('id');
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->integer('form_id')->unsigned();
            $table->foreign('form_id')
                ->references('id')
                ->on('forms')
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
        Schema::dropIfExists('event_forms');
    }
}
