<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('fields', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->string('fieldText');

            $table->boolean('fieldRequired');

            $table->integer('fieldMaxLenght')->unsigned();

            $table->string('fieldPlaceHolder');

            $table->integer('data_type_control_id')->unsigned();

            $table->softDeletes();

            $table->timestamps();

            $table->foreign('data_type_control_id')

                ->references('id')

                ->on('data_type_controls')

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

        Schema::dropIfExists('fields');

    }
}
