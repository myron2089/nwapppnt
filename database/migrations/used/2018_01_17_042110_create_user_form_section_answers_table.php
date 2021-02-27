<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFormSectionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *form_section_field_answers
     * @return void
     */
    public function up()
    {
        Schema::create('user_form_section_answers', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->integer('formSectionFieldAnswer_id')->unsigned();

            $table->foreign('formSectionFieldAnswer_id')

                ->references('id')

                ->on('form_section_field_answers')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->integer('form_id')->unsigned();

            $table->foreign('form_id')

                ->references('id')

                ->on('forms')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')

                ->references('id')

                ->on('users')

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
        Schema::dropIfExists('user_form_section_answers');
    }
}
