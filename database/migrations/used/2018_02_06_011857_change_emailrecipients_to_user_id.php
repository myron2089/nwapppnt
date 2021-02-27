<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeEmailrecipientsToUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_notification_recipients', function (Blueprint $table) {

            $table->dropForeign('email_notification_recipients_user_event_id_foreign');
            $table->dropColumn('user_event_id');

        });

        Schema::table('email_notification_recipients', function (Blueprint $table) {

            $table->integer('user_id')->unsigned()->nullable();

            $table->foreign('user_id')

                ->references('id')

                ->on('users')

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
        Schema::table('email_notification_recipients', function (Blueprint $table) {

            $table->dropForeign('email_notification_recipients_user_id_foreign');
            $table->dropColumn('user_id');

        });
    }
}
