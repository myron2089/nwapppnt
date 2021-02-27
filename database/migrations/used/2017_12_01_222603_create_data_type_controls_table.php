<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTypeControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('data_type_controls', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->integer('control_id')->unsigned();

            $table->integer('data_type_id')->unsigned();

            $table->softDeletes();

            $table->timestamps();

            $table->foreign('control_id')

                ->references('id')

                ->on('controls')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->foreign('data_type_id')

                ->references('id')

                ->on('data_types')

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

        Schema::dropIfExists('data_type_controls');

    }
}
