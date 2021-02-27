<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SwitchUserFormForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_form_section_answers', function (Blueprint $table) {

             $table->dropForeign('user_form_section_answers_formsectionfieldanswer_id_foreign');

            $table->dropColumn('formSectionFieldAnswer_id');


        });

        Schema::table('form_section_field_answers', function (Blueprint $table) {

            $table->integer('user_form_section_answer_id')->unsigned()->nullable();

            $table->foreign('user_form_section_answer_id')

                ->references('id')

                ->on('user_form_section_answers')

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

        Schema::table('form_section_field_answers', function (Blueprint $table) {

            $table->dropForeign('form_section_field_answers_user_form_section_answer_id_foreign');

            $table->dropColumn('user_form_section_answer_id');


        });
    }
}
