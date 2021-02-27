<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyCountryCodeToUserEventBadges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_event_badges', function (Blueprint $table) {

            $table->string('userCountryCode')->nullable();


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

            $table->dropColumn('userCountryCode');


        });
    }
}
