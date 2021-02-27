<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderToEventWebResources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('event_web_resources', function (Blueprint $table) {


            $table->integer('eventWebResourceOrder')->unsigned();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_web_resources', function (Blueprint $table) {

            $table->dropColumn('eventWebResourceOrder');


        });
    }
}
