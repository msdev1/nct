<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleTableTemplateV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public $Name='SuperModule';
    public function up()
    {
      $table=$this->Name;
      Schema::create($table, function (Blueprint $table) {
          $table->increments('id');
          $table->string('ModuleCode')->unique();
          $table->string('ModuleName');
          $table->string('ModuleLink');
          $table->string('ModuleParent');
          $table->string('ModuleCount');
          $table->string('ModuleUsers');
          $table->string('ModuleAccessCode');
          $table->json('ExtraField')->default(json_encode(array(), true));
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
