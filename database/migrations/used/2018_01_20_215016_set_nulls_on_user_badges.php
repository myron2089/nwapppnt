<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetNullsOnUserBadges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_event_badges', function (Blueprint $table) {



            $table->dropColumn('userTitle');

            $table->dropColumn('userCompanyName');

            $table->dropColumn('userAddress');

            $table->dropColumn('userPhoneNumber');


        });

        Schema::table('user_event_badges', function (Blueprint $table) {


            $table->string('userTitle')->nullable();

            $table->string('userCompanyName')->nullable();

            $table->string('userAddress')->nullable();

            $table->bigInteger('userPhoneNumber')->nullable();


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



            $table->dropColumn('userTitle');

            $table->dropColumn('userCompanyName');

            $table->dropColumn('userAddress');

            $table->dropColumn('userPhoneNumber');


        });
    }
}
