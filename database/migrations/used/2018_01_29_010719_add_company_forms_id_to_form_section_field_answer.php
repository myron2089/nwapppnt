<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyFormsIdToFormSectionFieldAnswer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_section_field_answers', function (Blueprint $table) {


            $table->integer('company_form_id')->unsigned()->nullable();

            $table->foreign('company_form_id')

                ->references('id')

                ->on('company_forms')

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

            $table->dropForeign('form_section_field_answers_company_form_id_foreign');

            $table->dropColumn('company_form_id');


        });
    }
}
