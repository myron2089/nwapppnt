<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormSectionFieldAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('form_section_field_answers', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->integer('form_section_field_id')->unsigned();

            $table->string('answerValue');

            $table->softDeletes();

            $table->timestamps();

            $table->foreign('form_section_field_id')

                ->references('id')

                ->on('form_section_fields')

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

        Schema::dropIfExists('form_section_field_answers');

    }
}
