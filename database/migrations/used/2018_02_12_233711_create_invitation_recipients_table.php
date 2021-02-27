<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitationRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitation_recipients', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->bigInteger('invitation_id')->unsigned();

            $table->foreign('invitation_id')

                ->references('id')

                ->on('invitations')

                ->onDelete('cascade')

                ->onUpdate('cascade');

            $table->string('recipientEmail');

            $table->softDeletes();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitation_recipients');
    }
}
