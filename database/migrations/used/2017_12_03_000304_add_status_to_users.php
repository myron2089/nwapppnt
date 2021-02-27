<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('users', function (Blueprint $table) {


            $table->integer('user_status_id')->unsigned();

            $table->foreign('user_status_id')

                ->references('id')

                ->on('user_statuses')

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

        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn('user_status_id');


        });

    }
}
