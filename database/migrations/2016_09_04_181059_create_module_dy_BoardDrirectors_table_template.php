<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleDyBoardDrirectorsTableTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $Name='Mod_DY_BoardDirectors';
    public function up()
    {
        Schema::create($this->Name, function (Blueprint $table) {
            $table->increments('id');
            $table->string('FullName');
            $table->string('Designation');
            $table->string('Address');
            $table->string('Email');
            $table->string('ContactNo');
            $table->json('ExtraField');
            $table->boolean('Status')->default(false);
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
        Schema::drop($this->Name);
    }
}
