<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPicturePositionOcupationPictureToUserEventBadges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_event_badges', function (Blueprint $table) {


            $table->string('userPicture')->default('noUserPicture.png');

            $table->string('userPicturePath')->nullable();

            $table->string('userPosition')->nullable();

            $table->string('userOccupation')->nullable();


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

            $table->dropColumn('userPicture');

            $table->dropColumn('userPicturePath');

            $table->dropColumn('userPosition');

            $table->dropColumn('userOccupation');

        });

    }
}
