<?php

use Illuminate\Database\Seeder;

class master_dy_organization_details_template extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

            Schema::create($this->Name, function (Blueprint $table) {
            $table->increments('id');
            $table->string('FullName');
            $table->string('Address');
            $table->string('Email');
            $table->string('ContactNo');
            $table->string('Parent');
            $table->string('Type');
            $table->string('Web');
            $table->json('ExtraField');
            $table->boolean('Status')->default(false);
            $table->timestamps();
        });


    /*
     Master Template of Seed Module Table
     exmple
     [
       'FullName'=>,
       'Address1'=>,
       'Address2'=>,
       'Address3'=>,
       'City'=>,
       'Email'=>,
       'ContactNo'=>,
       'Parent'=>,
       'Type'=>,
       'Web'=>,
       'Status'=>,
     ],
     */

     public $masterTemplate = [
     [
       'FullName'=>'Narmada Clean Tech (NCT)',
       'Address1'=>'Surati Bhagor',
       'Address2'=>'Nr. Gujarat Gas Office ,Umarvada Road ',
       'Address3'=>'Dist-Bharuch. (Guj.)',
       'City'=>'Ankleshwar,
       'Email'=>,
       'ContactNo'=>,
       'Parent'=>,
       'Type'=>,
       'Web'=>,
       'Status'=>,
     ],
     ];
    public function run()
    {
        //
    }
}
