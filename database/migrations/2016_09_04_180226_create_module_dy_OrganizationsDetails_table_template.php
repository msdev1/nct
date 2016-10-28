<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleDyOrganizationsDetailsTableTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $Name='Mod_DY_OrganizationDetails';
    public function up()
    {
        Schema::create($this->Name, function (Blueprint $table) {
            $table->increments('id');
            $table->string('FullName');
            $table->string('Address1');
            $table->string('Address2');
            $table->string('Address3');
            $table->string('City');
            $table->string('Pincode');
            $table->string('Email');
            $table->string('ContactNo');
            $table->string('Parent');
            $table->string('Type');
            $table->string('Web');
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
