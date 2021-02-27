<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_forms', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->integer('company_id')->unsigned();

            $table->foreign('company_id')

                ->references('id')

                ->on('companies')

                ->onDelete('restrict')

                ->onUpdate('cascade');

            $table->integer('form_id')->unsigned();

            $table->foreign('form_id')

                ->references('id')

                ->on('forms')

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
        Schema::dropIfExists('company_forms');
    }
}
