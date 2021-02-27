<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyInvitations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('invitations', function (Blueprint $table) {

            $table->dropColumn('status');


        });
        Schema::table('invitations', function (Blueprint $table) {

            $table->integer('status')->unsigned();

            $table->string('recipientEmail');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invitations', function (Blueprint $table) {

            $table->dropColumn('status');

            $table->dropColumn('recipientEmail');


        });
    }
}
