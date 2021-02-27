<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->integer('event_id')->unsigned();

            $table->foreign('event_id')

                ->references('id')

                ->on('events')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->string('companyName');

            $table->text('companyDescription')->nullable();

            $table->text('companyAddress')->nullable();

            $table->bigInteger('companyPhone')->nullable();

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
        Schema::dropIfExists('companies');
    }
}
