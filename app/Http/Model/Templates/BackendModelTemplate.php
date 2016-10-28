<?php

namespace BModel;

class {classname} extends \BModel\BaseModel
{

  protected $table = '';
  protected $connection = '';
  protected $visible = [

                        ];
  protected $uniq=[

                  ];
  protected $casts = ['Status' => 'boolean',];
  protected $fillable = ['Status'];
  protected $hidden = [

                      ];
  protected $columnMaster=[
                            //'ShortName'=>'ColumnName',
                          ];

  public $formMaster=[
                    //  'ColumnName'=>[
                    //                'Lable'=>'Lable Name to disply on Form',
                    //                'Type'=>'Input Type',
                    //                'PlaceHolder'=>'PlaceHolder to disply on Form',
                    //                'value'=>'Value or default Value',
                    //                ],
                      ];
  public $formMasterExtra=[
                        //'CustomInputType'=>'ClassMethodName',
                        ];
  public $rules=[
                //'ColumnName'=>'rules',
                ];
  public $massage=[
                  'required'=>'Please enter :attribute .',
                  'string'=>'Please enter valid :attribute .',
                  'json'=>'Please enter valid json input in :attribute .',
                  'boolean'=>'Please select valid option in :attribute .',
                  ];

  public $formMethod='';              //default form submit method
  public $fromAction='';              //default form controller method

  //////////////////////////////////////////////////////////
  ////////////Extra Methods For Form Genration ////////////
  ////////////////////////////////////////////////////////

  ////////////////////////////////////////////////////////
  //-----------------------END-------------------------//
  //////////////////////////////////////////////////////



  /////////////////////////////////////////////////////////
  ////////////Auto Genration Methods For Colun////////////
  ///////////////////////////////////////////////////////

  ////////////////////////////////////////////////////////
  //-----------------------END-------------------------//
  //////////////////////////////////////////////////////



  ///////////////////////////////////////////////
  ////////////Form Genration Methods////////////
  /////////////////////////////////////////////

  ////////////////////////////////////////////////////////
  //-----------------------END-------------------------//
  //////////////////////////////////////////////////////


  //////////////////////////////////////
  ////////////Event Methods////////////
  ////////////////////////////////////

  ////////////////////////////////////////////////////////
  //-----------------------END-------------------------//
  //////////////////////////////////////////////////////



}
