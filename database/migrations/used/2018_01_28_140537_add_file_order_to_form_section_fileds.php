<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFileOrderToFormSectionFileds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('form_section_fields', function (Blueprint $table) {


            $table->integer('fieldOrder')->unsigned()->nullable();


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('form_section_fields', function (Blueprint $table) {



            $table->dropColumn('fieldOrder');


        });

    }
}
