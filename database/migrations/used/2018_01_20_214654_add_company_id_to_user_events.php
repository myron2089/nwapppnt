<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyIdToUserEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_events', function (Blueprint $table) {


            $table->integer('company_id')->unsigned()->nullable();

            $table->foreign('company_id')

                ->references('id')

                ->on('companies')

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
        Schema::table('user_events', function (Blueprint $table) {

            $table->dropForeign('user_events_company_id_foreign');

            $table->dropColumn('company_id');


        });
    }
}
