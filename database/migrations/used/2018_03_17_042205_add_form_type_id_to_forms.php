<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFormTypeIdToForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('forms', function (Blueprint $table) {

            $table->integer('form_type_id')->unsigned()->nullable();

            $table->foreign('form_type_id')

                ->references('id')

                ->on('form_types')

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
        Schema::table('forms', function (Blueprint $table) {

            $table->dropColumn('form_type_id');

        });
    }
}
