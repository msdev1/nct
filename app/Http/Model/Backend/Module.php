<?php

namespace BModel;

use Illuminate\Database\Eloquent\Model;

class Module extends \BModel\BaseModel
{

  protected $table = 'SuperModule';
  protected $connection = 'master';
  protected $hidden = [];
  protected $visible = ['ModuleCode','ModuleUsers','ModuleAccessCode','id','ModuleName', 'ModuleLink','ModuleParent','ModuleCount','','ExtraField','Status'];
  protected $casts = ['Status' => 'boolean',];
  protected $fillable = [
      'ModuleName', 'ModuleStructure','ExtraField','Status','ModuleCode',
  ];
/*
Main Table Structure
exmple
[
'ShortName'=>'TableName'
]
*/
  protected $columnMaster=[
                            'mname'=>'ModuleName',
                            'mcode'=>'ModuleCode',
                            'mlink'=>'ModuleLink',
                            'mparent'=>'ModuleParent',
                            'mcount'=>'ModuleCount',
                            'muser'=>'ModuleUsers',
                            'mscode'=>'ModuleAccessCode',
                            'extra'=>'ExtraField',
                            'st'=>'Status',
                            'id'=>'id'

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
                             'id'=>[
                             'Lable'=>'id',
                             'Type'=>'hidden',
                             'PlaceHolder'=>'Enter id',
                             
                            ],
                            'ModuleName'=>[
                              'Lable'=>'Module Name',
                              'Type'=>'text',
                              'PlaceHolder'=>'Enter Module Name',
                              'value'=>'',
                            ],
                            'ModuleCode'=>[
                              'Lable'=>'Module Code',
                              'Type'=>'auto.ModuleCode',
                              'PlaceHolder'=>'Enter Module Code',
                            ],
                            'ModuleLink'=>[
                              'Lable'=>'Module Link',
                              'Type'=>'text',
                              'PlaceHolder'=>'Module Link',
                            ],
                            'ModuleParent'=>[
                              'Lable'=>'Module Parent',
                              'Type'=>'auto.ModuleParent',
                              'PlaceHolder'=>'Module Parent',
                            ],
                            'ModuleCount'=>[
                              'Lable'=>'Module Count',
                              'Type'=>'text',
                              'PlaceHolder'=>'Module Count',
                            ],
                            'ModuleUsers'=>[
                              'Lable'=>'Module Users',
                              'Type'=>'auto.ModuleUser',
                              'PlaceHolder'=>'Module Users',
                            ],
                            'ModuleAccessCode'=>[
                              'Lable'=>'Module Access Code',
                              'Type'=>'auto.ModuleAccessCode',
                              'PlaceHolder'=>'Module Access Code',
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
  'auto.ModuleCode'=>'autoModuleCode',
  'auto.ModuleParent'=>'autoModuleParent',
  'auto.ModuleUser'=>'autoModuleUser',
  'auto.ModuleAccessCode'=>'autoModuleAccessCode',
                          ];

public $rules=[
                            'ModuleName'=>'required|string',
                            'ModuleCode'=>'required|string',
                            'ModuleLink'=>'required|string',
                            'ModuleParent'=>'required|numeric',
                            'ModuleCount'=>'required|numeric',
                            'ModuleUsers'=>'required|array',
                            'ModuleAccessCode'=>'required|string',
                            'ExtraField'=>'required|array',
                            'Status'=>'required|boolean|',
                          ];

public $massage=[
                            'required'=>'Please enter :attribute .',
                            'numeric'=>'Please enter :attribute .',
                            'string'=>'Please enter valid :attribute .',
                            'json'=>'Please enter valid json input in :attribute .',
                            'boolean'=>'Please select valid option in :attribute .',
                          ];

/*
Only this class function
*/

/*

//ClassName:BModel/Module::class
//Fuction Name:module_delete
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
//Function Start/End Line:146/201
*/

public function module_delete ($input){
  //return $input->all();
  
  if($this->deleteByid($input->all()['id'])){
      return [
        'ok'=>true,
        'msg'=>['Module Deleted successfully.'],
        
        ];
  }

  return [
        'ok'=>false,
        'msg'=>['Module not Deleted successfully.'],
        
        ];
 // return $this->deleteByid($input->all()['id']);
    


}

public function module_update ($input,$array){
  //return $input->all();
   
  if($this->updateByid($input['id'],$array)){
      return [
        'ok'=>true,
        'msg'=>['Module Updated successfully.'],
        
        ];
  }

  return [
        'ok'=>false,
        'msg'=>['Module not Updated successfully.'],
        
        ];
 // return $this->deleteByid($input->all()['id']);
    


}



/*
//ClassName:BModel/Module::class
//Fuction Name:module_add
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
//Function Start/End Line:146/201
*/

public function module_add ($input){
  $input=$input->all();
  /*
  custom auto calculate script
  */
  $error=false;
  if(!array_key_exists('ModelCount',$input)){
       $parent=$input['ModuleParent'];
       if(!($parent=='0')){
        $count=$this->where('id',$parent)->pluck('ModuleCount')->first();
        $count=$count+1;
        $input['ModuleCount']=$count;
        }else{
        $input['ModuleCount']=0;
      }
      }

      if(array_key_exists('ModuleUsers',$input)){
        if(is_array($input['ModuleUsers'])){
          $user=new User ();
          foreach ($input['ModuleUsers'] as $key => $value) {
            $modUser[]=$user->where('id',$value)->pluck('UserCode')->first();
          }
          $input['ModuleUsers']=$modUser;
        }
      }
      /*
      Validation Script
      */
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
      $array2=$mod->feedMod($input);
      if($mod->feed($array2) && $mod->checkSave()){
        return [
        'ok'=>true,
        'msg'=>['Module Added successfully.'],
        'data'=>['input'=>$input],
        ];
      }
      return [
        'ok'=>false,
        'msg'=>['Module Not Added successfully.'],
        ];
      return true;

}

public function moduleAddForm(){
  $field=['ModuleName','ModuleCode','ModuleLink','ModuleParent','ModuleUsers','ModuleAccessCode','ExtraField','Status'];
  $button=['Add'=>['value'=>'submit','class'=>'btn-success'],'Reset'=>['value'=>'reset','class'=>'btn-warning']];
  $this->displayForm($field,'post','\Backend\PanelController@module_Add',$button,'btn-success','addModule');
  return true;

}

public function moduleUpdateForm($id){
  $field=['id','ModuleName','ModuleLink','ModuleParent','ModuleUsers','ModuleAccessCode','Status'];
  $button=['Save'=>['value'=>'submit','class'=>'btn-success'],'Reset'=>['value'=>'reset','class'=>'btn-warning']];
  $this->displayForm($field,'post','\Backend\PanelController@module_Update',$button,'btn-success','updateModule',$id);
  return true;

}
public function getChildNav($parent){
  $childNav=$this->where('id',$parent)->get();
  dd($childNav);
}
public function nav($user){
  //$user=$this->all()->toArray();
  $user=$this->all()->groupBy('ModuleCount')->toArray();
  echo "<pre>";

  foreach ($user as  $key1=>$value1) {
    var_dump($key1);
  foreach ($value1 as $value2) {
    var_dump($value2['ModuleName']);
  }

  }
  return $user  ;

                          }
public function makeCount($parent){

}
/*
Automatic Field Genration function
*/
public function newModCode(){
                            $mc=str_random(4);
                            while ($this->where('ModuleCode',$mc)->first() == null) {
                            return $mc;
                              }
                          return false;
                          }

public function autoModuleCode($name)
                          {
                            $input=$this->formMaster[$name];
                          //  dd(gettype($this->newModCode()));
                            $modcode=$this->newModCode();
                            $final='<div class="form-group">'
                            .\Form::label($name, $input['Lable']." : ", array())
                            .\Form::text($name."_disabled",$modcode,['placeholder'=>$input['PlaceHolder'],'disabled'=>true,'class'=>"form-control"])
                            .'<input type="hidden" name="'.$name.'" value="'.$modcode.'"></div>';
                            return $final;
                          }
public function autoModuleParent($name,$value=null)
                              {

                               // var_dump($value);
                              $v1=0;  
                              if($value!=null)$v1=$value;
                              
                              $input=$this->formMaster[$name];
                              $final='<div class="form-group">'
                              .\Form::label($name, $input['Lable']." : ", array());

                              $count=$this->where('ModuleCount','<',2)->pluck('ModuleName','id')->toArray();
                              $count[0]='No Parent';

                              $radio='';

                              foreach ($count as $key => $value) {
                                //var_dump($key);
                                
                                if($key==$v1){
                                 // var_dump($key);
                                  $radio.=\Form::radio($key, $value,['class'=>"form-control","selected"]);
                                }else{
                                $radio.=\Form::radio($key, $value,['class'=>"form-control"]);  
                                }
                                

                              }
                              $radio=\Form::select($name, $count, $v1,["class"=>"form-control"]);
                              $final.=$radio;

                              $final.='</div>';
                                                      return $final;
                                                    }
public function autoModuleUser($name,$value=null)
{ 
  
                              $input=$this->formMaster[$name];
                              $final='<div class="form-group">'
                              .\Form::label($name."[]", $input['Lable']." : ", array());
                              $user=new \BModel\User ();
                              
                              $count=$user->pluck('UserName','id')->toArray();
                              $countCode=$user->pluck('UserName','UserCode')->toArray();
                              if($value!=null){
                                $v1=json_decode($value,true);
                                $radio=\Form::select($name."[]", $countCode, $v1,["class"=>"form-control",'multiple']);
                              }else{
                              $radio=\Form::select($name."[]", $count, '0',["class"=>"form-control",'multiple']);  
                              }
                              
                              
                              $final.=$radio;
                              $final.='</div>';
                              return $final;

                                    }
public function autoModuleAccessCode($name,$value=null)
                                    {

                                      
                                      //if($value!=null)dd($value);
                                    $input=$this->formMaster[$name];
                                    $final='<div class="form-group">'.\Form::label($name, $input['Lable']." : ", array());
                                    //$user=new \BModel\User ();
                                    //$count=$user->pluck('UserName','id')->toArray();
                                    $count=[
                                      0=>0,
                                      1=>1,
                                      2=>2,
                                      3=>3,
                                      4=>4,
                                      5=>5,
                                      6=>6,
                                      7=>7,
                                      8=>8,
                                      9=>9,
                                      10=>10,
                                    ];
                                    if($value!=null){
                                      $radio=\Form::select($name, $count, $value,["class"=>"form-control"]);
                                    }else{
                                      $radio=\Form::select($name, $count, '0',["class"=>"form-control"]);
                                    }
                                    
                                    
                                    $final.=$radio;
                                    $final.='</div>';
                                    return $final;
                                                                        }
/*
Validation & Feed Function
*/
public function feedMod($modArray){

                            $modArrayFinal=[
                                'ModuleCode'=>$this->newModCode(),
                                'ModuleName'=>$modArray['ModuleName'],
                                'ModuleLink'=>$modArray['ModuleLink'],
                                'ModuleParent'=>$modArray['ModuleParent'],
                                'ModuleCount'=>$modArray['ModuleCount'],
                                'ModuleUsers'=>json_encode($modArray['ModuleUsers'],true),
                                'ModuleAccessCode'=>$modArray['ModuleAccessCode'],
                                'ExtraField'=>json_encode([],true),
                                'Status'=>$modArray['Status'],
                              ];
                              return $modArrayFinal;
                          }

public function checkSave()
                            {

                                $e=0;
                                $e=$this->checkSavelvl1($this);
                                if($e==0){
                                  if($this->where('ModuleCode',$this->attributes['ModuleCode'])->first() == null){
                                    $this->save();
                                  return true;
                                  }
                                return false;
                                }
                               return false;
                                
                             }



















}
