<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeEmailNotificationFromToUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_notifications', function (Blueprint $table) {

            $table->dropForeign('email_notifications_emailnotificationfrom_foreign');
            $table->dropColumn('emailNotificationFrom');

        });

        Schema::table('email_notifications', function (Blueprint $table) {

            $table->integer('emailNotificationFrom')->unsigned()->nullable();

            $table->foreign('emailNotificationFrom')

                ->references('id')

                ->on('users')

                ->onDelete('cascade')

                ->onUpdate('cascade');

            $table->integer('event_id')->unsigned()->nullable();

            $table->foreign('event_id')

                ->references('id')

                ->on('events')

                ->onDelete('cascade')

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
        Schema::table('email_notifications', function (Blueprint $table) {

            $table->dropForeign('email_notifications_emailnotificationfrom_foreign');
            $table->dropColumn('emailNotificationFrom');
            $table->dropColumn('event_id');

        });
    }
}
