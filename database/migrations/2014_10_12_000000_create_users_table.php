<?php

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
        Schema::create('SuperAdmin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('UserName')->unique();
            $table->string('UserCode')->unique();
            $table->string('AccessCode');
            $table->string('PassWord');
            $table->string('ContactNo');
            $table->string('eMail')->unique();
            $table->ipAddress('LastLogin_ip')->default('0.0.0.0');
            $table->ipAddress('CurrentLogin_ip')->default('0.0.0.0');
            $table->string('JetKey');
            $table->string('EmailCode');
            $table->json('ExtraField');
            $table->boolean('Status')->default(false);
            $table->boolean('EmailVeryfied')->default(false);
            $table->boolean('CurrentLogin_status')->default(false);
            $table->rememberToken();
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
        Schema::drop('SuperAdmin');
    }
}
