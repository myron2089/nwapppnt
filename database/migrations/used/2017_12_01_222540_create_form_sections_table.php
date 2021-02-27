<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_sections', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->integer('form_id')->unsigned();

            $table->integer('section_id')->unsigned();

            $table->softDeletes();

            $table->timestamps();

            $table->foreign('form_id')

                ->references('id')

                ->on('forms')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->foreign('section_id')

                ->references('id')

                ->on('sections')

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

        Schema::dropIfExists('form_sections');

    }
}
