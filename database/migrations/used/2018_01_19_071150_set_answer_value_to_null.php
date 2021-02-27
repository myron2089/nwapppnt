<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetAnswerValueToNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_section_field_answers', function (Blueprint $table) {



            $table->dropColumn('answerValue');


        });

        Schema::table('form_section_field_answers', function (Blueprint $table) {


            $table->string('answerValue')->nullable();


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



            $table->dropColumn('answerValue');


        });
    }
}
