<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {

            $table->bigInteger('id')->unsigned();

            $table->primary('id');

            $table->integer('userFrom')->unsigned();

            $table->foreign('userFrom')

                ->references('id')

                ->on('users')

                ->onDelete('cascade')

                ->onUpdate('cascade');

            $table->integer('event_id')->unsigned();

            $table->foreign('event_id')

                ->references('id')

                ->on('events')

                ->onDelete('cascade')

                ->onUpdate('cascade');

            $table->string('subject');

            $table->string('body');

            $table->string('status');

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
        Schema::dropIfExists('invitations');
    }
}
