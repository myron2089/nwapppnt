<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEventFormIdToCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {


            $table->integer('event_form_id')->unsigned()->nullable();

            $table->foreign('event_form_id')

                ->references('id')

                ->on('event_forms')

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
        Schema::table('event_forms', function (Blueprint $table) {

            $table->dropForeign('event_form_id_foreign');

            $table->dropColumn('event_form_id');


        });
    }
}
