<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSaleNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_sale_notes', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->integer('user_event_id')->unsigned();

            $table->foreign('user_event_id')

                ->references('id')

                ->on('user_events')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->integer('sale_id')->unsigned();

            $table->foreign('sale_id')

                ->references('id')

                ->on('sales')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->text('note');

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
        Schema::dropIfExists('user_sale_notes');
    }
}
