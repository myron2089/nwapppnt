<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPathPictureToCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('companies', function (Blueprint $table) {


            $table->string('companyPicture')->nullable();

            $table->string('companyPicturePath')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {

            $table->dropColumn('companyPicture');

            $table->dropColumn('companyPicturePath');


        });
    }
}
