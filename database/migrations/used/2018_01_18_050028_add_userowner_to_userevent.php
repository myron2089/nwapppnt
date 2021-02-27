<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserownerToUserevent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_events', function (Blueprint $table) {


            $table->integer('user_owner_id')->unsigned()->nullable();

            $table->foreign('user_owner_id')

                ->references('id')

                ->on('users')

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

            $table->dropForeign('user_events_user_owner_id_foreign');

            $table->dropColumn('user_owner_id');


        });
    }
}
