<?php

namespace BModel\Modules\DY;

use Illuminate\Database\Eloquent\Model;

class BasicSettings extends \BModel\BaseModel
{


  protected $table = 'Mod_DY_BasicSettings';
  protected $connection = 'master';
  protected $hidden = [];
  protected $visible = ['id','SiteTitle', 'Keywords','LogoPath','CopywriteText','ExtraField','Status'];
  protected $casts = ['Status' => 'boolean',];
  protected $fillable = [
      'SiteTitle', 'Keywords','LogoPath','CopywriteText','ExtraField','Status',
  ];
/*
Main Table Structure
exmple
[
'ShortName'=>'TableName'
]
*/
  protected $columnMaster=[
                            'stitle'=>'SiteTitle',
                            'kword'=>'Keywords',
                            'lpath'=>'LogoPath',
                            'copytext'=>'CopywriteText',
                            'extra'=>'ExtraField',
                            'st'=>'Status',
                          ];
/*
Table Form Structure
exmple
[
'TableName1'=>[
              'Lable'=>'Text To Display',
              'Type'=>'Input Type required',
              'PlaceHolder'=>'PlaceHolder To Display',
              'value'=>'default values',
              'Option'=>'' <===only valid for type radio & option,
            ],
]
*/
public $formMaster=[
                            'SiteTitle'=>[
                              'Lable'=>'Site Name',
                              'Type'=>'text',
                              'PlaceHolder'=>'Enter Site Name',
                              'value'=>''
                              
                            ],
                            'Keywords'=>[
                              'Lable'=>'Keywords',
                              'Type'=>'text',
                              'PlaceHolder'=>'Enter Keywords',
                            ],
                            'LogoPath'=>[
                              'Lable'=>'Logo Link',
                              'Type'=>'text',
                              'PlaceHolder'=>'EnterLogo Link',
                            ],
                            'CopywriteText'=>[
                              'Lable'=>'Copywrite Text',
                              'Type'=>'text',
                              'PlaceHolder'=>'Enter Copywrite Text',
                            ],
                            'ExtraField'=>[
                              'Lable'=>'ExtraField',
                              'Type'=>'json',
                              'PlaceHolder'=>'Auto Genrated',
                            ],
                            'Status'=>[
                              'Lable'=>'Status',
                              'Type'=>'radio',
                              'Option'=>['Active'=>1,'Deactive'=>0],
                            ],

                          ];
public $formMasterExtra=[

                          ];

public $rules=[
                            'SiteTitle'=>'required|string',
                            'Keywords'=>'required|string',
                            'LogoPath'=>'required|string',
                            'CopywriteText'=>'required|string',
                            'ExtraField'=>'required|string',
                            'Status'=>'required|boolean',
                          ];

public $massage=[
                            'required'=>'Please enter :attribute .',
                            'string'=>'Please enter valid :attribute .',
                            'json'=>'Please enter valid json input in :attribute .',
                            'boolean'=>'Please select valid option in :attribute .',
                          ];




/*
Only this class function
*/

/*

//ClassName:BModel\Modules\DY\MainModel::class
//Fuction Name:update
//Function Required Input:$input (Class)
//Function Optional Input:
//Function True Output:[
                        'ok'=>true,
                        'msg'=>msg,
                        'data'=>Custom Data
                        ]
//Function False Output:[
                        'ok'=>true,
                        'msg'=>Custom error msg
                        ]
//Function Start/End Line:125/201
*/

public function getDetails(){
  if($this->all()->first() ==null){
    return [
    'SiteTitle'=>'Default Website Title',
    'Keywords'=>'Default Keywords',
    'LogoPath'=>'images/client/companyLogo_small_1.png',
    'CopywriteText'=>'Copywrite text',
    'Status'=>'1',
    ];
  }
  return $this->all()->first()->toArray();

}

public function updateForm($id=null){
  $id=$this->pluck('id')->first();
  //dd($id);
  $id='1';
  $field=['SiteTitle','Keywords','LogoPath','CopywriteText','Status'];
  $button=['Update'=>['value'=>'submit','class'=>'btn-success'],'Reset'=>['value'=>'reset','class'=>'btn-warning']];
  //dd($this->displayForm($field,'post','\Backend\Modules\DY\BasicSettings\MainController@save',$button,'btn-success','updateBasic',$id));
  if($id!=null){
  $this->displayForm($field,'post','\Backend\Modules\DY\BasicSettings\MainController@save',$button,'btn-success','updateBasic',$id);
  }else{
    $this->displayForm($field,'post','\Backend\Modules\DY\BasicSettings\MainController@save',$button,'btn-success','updateBasic');
  }
  

  return true;

    }
/*
//ClassName:BModel\Modules\DY\MainModel::class
//Fuction Name:update
//Function Required Input:$input (Class)
//Function Optional Input:
//Function True Output:[
                        'ok'=>true,
                        'msg'=>msg,
                        'data'=>Custom Data
                        ]
//Function False Output:[
                        'ok'=>true,
                        'msg'=>Custom error msg
                        ]
//Function Start/End Line:125/201
*/

public function DBupdate($input){
  $input=$input->all();
  /*
  custom auto calculate script
  */
  $error=false;
  if(!array_key_exists('id',$input)){
       $input['id']='1';
      }

      /*
      Validation Script
      */
      $array2=$this->feedMod($input,false);
      
      foreach ($array2 as $key => $value) {
        $input[$key]=$value;
      }
      //dd($input);

      $validator = \Validator::make($input,$this->rules,$this->massage);
      
      /*
      database triger Script
      */
      if($validator->fails()){
         return [
        'ok'=>false,
        'msg'=>$validator->errors()->all(),
        ];
      }
      $mod=$this;

      if($mod->where('id', $input['id'])->first() != null){

        $array2=$mod->feedMod($input,false);
        $mod=$mod->where('id', $input['id'])->update($array2);

         if($mod){
        return [
        'ok'=>true,
        'msg'=>['Basic Settings Updated successfully.'],
        'data'=>['input'=>$input],
        ];
      }

      }else{

        $array2=$mod->feedMod($input);
        $mod->feed($array2);
        $mod=$mod->checkSave();

         if($mod){
        return [
        'ok'=>true,
        'msg'=>['Basic Settings Created successfully.'],
        'data'=>['input'=>$input],
        ];
      }
      }

     
     
      return [
        'ok'=>false,
        'msg'=>['Module Not Added successfully.'],
        ];
      //return true;

    }

    public function feedMod($array,$json=true){

      if($json){
          $arrayFinal=[
                                'SiteTitle'=>$array['SiteTitle'],
                                'Keywords'=>$array['Keywords'],
                                'LogoPath'=>$array['LogoPath'],
                                'CopywriteText'=>$array['CopywriteText'],
                                'ExtraField'=>'false',
                                'Status'=>$array['Status'],
                              ];
      }else{
        $arrayFinal=[
                                'SiteTitle'=>$array['SiteTitle'],
                                'Keywords'=>$array['Keywords'],
                                'LogoPath'=>$array['LogoPath'],
                                'CopywriteText'=>$array['CopywriteText'],
                                'ExtraField'=>'false',
                                'Status'=>$array['Status'],
                              ];
      }
                            
                              return $arrayFinal;
                          }
      public function checkSave()
                            {

                                $e=0;
                                $e=$this->checkSavelvl1($this);
                                if($e==0){
                                  if($this->where('SiteTitle',$this->attributes['SiteTitle'])->first() == null){
                                    $this->save();
                                  return true;
                                  }
                                return false;
                                }
                               return false;
                                
                             }




	
}


