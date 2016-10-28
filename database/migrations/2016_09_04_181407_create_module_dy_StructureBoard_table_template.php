<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleDyStructureBoardTableTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $Name='Mod_DY_BoardStrure';
    public function up()
    {
         Schema::create($this->Name, function (Blueprint $table) {
            $table->increments('id');
            $table->string('MethodAppoint');
            $table->string('BoardMembers');
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
