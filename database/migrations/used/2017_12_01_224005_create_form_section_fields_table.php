<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormSectionFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('form_section_fields', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->integer('form_section_id')->unsigned();

            $table->integer('field_id')->unsigned();

            $table->softDeletes();

            $table->timestamps();

            $table->foreign('form_section_id')

                ->references('id')

                ->on('form_sections')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->foreign('field_id')

                ->references('id')

                ->on('fields')

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

        Schema::dropIfExists('form_section_fields');

    }
}
