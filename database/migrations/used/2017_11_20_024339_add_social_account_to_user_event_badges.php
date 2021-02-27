<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialAccountToUserEventBadges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('user_event_badges', function (Blueprint $table) {


            $table->string('userFacebook')->nullable();

            $table->string('userTwitter')->nullable();


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('user_event_badges', function (Blueprint $table) {

            $table->dropColumn('userFacebook');

            $table->dropColumn('userTwitter');

        });

    }
}
