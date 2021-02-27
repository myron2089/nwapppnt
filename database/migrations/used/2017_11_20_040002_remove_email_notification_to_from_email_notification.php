<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveEmailNotificationToFromEmailNotification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('email_notifications', function (Blueprint $table) {

            $table->dropForeign('email_notifications_emailnotificationto_foreign');

            $table->dropColumn('emailNotificationTo');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('email_notifications', function (Blueprint $table) {


            $table->integer('emailNotificationTo')->unsigned();

            $table->foreign('emailNotificationTo')

                ->references('id')

                ->on('user_events')

                ->onDelete('restrict')

                ->onUpdate('cascade');


        });

    }
}
