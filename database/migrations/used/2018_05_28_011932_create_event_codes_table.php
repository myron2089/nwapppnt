<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_codes', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->primary('id');
            $table->integer('code_id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->foreign('code_id')
                ->references('id')
                ->on('codes')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('restrict')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('event_codes');
    }
}
