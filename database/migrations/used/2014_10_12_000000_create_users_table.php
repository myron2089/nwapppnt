<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('users', function (Blueprint $table) {

            $table->integer('id')->unsigned();

            $table->primary('id');

            $table->string('userFirstName');

            $table->string('userLastName');

            $table->string('userEmail')->unique();

            $table->string('userPassword');

            $table->string('userPhoneNumber')->nullable();

            $table->date('userBirthDay')->nullable();

            $table->text('userAddress')->nullable();

            $table->string('userPicture')->default('noPicture.png');

            $table->string('userPicturePath')->nullable();

            $table->rememberToken();

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

        Schema::dropIfExists('users');

    }
}
