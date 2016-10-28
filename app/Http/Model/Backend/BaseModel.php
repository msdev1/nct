<?php

namespace BModel;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

  public function secret($text=null,$decrpt=false){
    if($text==null)return false;
    if($decrpt){
      return \Crypt::decrypt($text);
    }else{
      return \Crypt::encrypt($text);
    }
  }
  public function check($array=[]){
    $e=0;
    if(!(count($this->columnMaster)==count($this->attributes)))return false;

    foreach ($this->columnMaster as $key => $value) {
    if(array_key_exists($value,$this->attributes)){
       if($e==0 and $this->attributes[$value] === null)$e=1;
      }else{
        $e=1;
      }
    }
    if($e==0){
      if($array!=null and count($array)>0){
        foreach ($array as $value) {
            if($e==0 and $this->where($value,$this->attributes[$value])->first() != null)$e=1;
          }
          if($e==0){
          $this->save();
          return true ;
          }

      }else{
      $this->save();
      return true ;
      }

    }
    return false;
}

  public function rules($array=array()){
                    if($array==null){
                      $ruleMaster=$this->rules;
                    }else{
                      foreach ($array as $value) {
                        if(array_key_exists($value,$this->rules)){
                          $ruleMaster[$value]=$this->rules[$value];
                        }
                      }
                    }
                    return $ruleMaster;
  }
  public function set($column,$value){
    $this->attributes[$this->columnMaster[strtolower($column)]]=$value;
    return true;
  }

  public function feed($array){
        $final=$this->feedData($array);
        foreach ($final as $key => $value) {
          $this->set($key,$value);
        }
      return true;
  }

  public function feedData($array){

      foreach ($this->master() as $key => $value) {
        if(array_key_exists($key,$array)){
            $final[$value]=$array[$key];
            unset($array[$key]);
        }
      }
      return $final;
  }

  public function master(){
    $final=array_flip($this->columnMaster);
    return $final;
  }

  public function displayForm($array=array(),$method=null,$action=null,$button=null,$btncolor='',$formid='001',$id=null)
  {
 
    if($id != null){
      $this->id=$id;
    }

    
    if($array==null and ($method==null and  $action==null)){
      $method=$this->formMethod;
      $action=$this->fromAction;
      $form=\MSModel\Comman::buildForm($this);
      $form=\MSModel\Comman::printForm($form,$method,$action,$button,$btncolor,"msDyna_Form_".$formid);
      $form=\MSModel\Comman::view($form);
    }else{
      $form=\MSModel\Comman::buildForm($this,1,$array);
      $form=\MSModel\Comman::printForm($form,$method,$action,$button,$btncolor,"msDyna_Form_".$formid);
      $form=\MSModel\Comman::view($form);
    }
    return true;
  }

  public function editForm($array=array(),$method=null,$action=null,$button=null,$btncolor='',$formid='001')
  {

    //$value1=

    if($array==null and ($method==null and  $action==null)){
      $method=$this->formMethod;
      $action=$this->fromAction;
      $form=\MSModel\Comman::buildForm($this,$value1);
      $form=\MSModel\Comman::printForm($form,$method,$action,$button,$btncolor,"msDyna_Edit_Form_".$formid);
      $form=\MSModel\Comman::view($form);
    }else{
      $form=\MSModel\Comman::buildForm($this,1,$array);
      $form=\MSModel\Comman::printForm($form,$method,$action,$button,$btncolor,"msDyna_Edit_Form_".$formid);
      $form=\MSModel\Comman::view($form);
    }
    return true;
  }


  public function active()
  {
      $this->attributes['Status'] = true;
  }

  public function deactive()
  {
      $this->attributes['Status'] = false;
  }

  public function deleteByid($id){
      if($this->where('id',$id)->first()==null){
        return false;
      }
      if($this->where('id', $id)->delete()){
        return true;
      }
      return false;
  }

  public function updateByid($id,$array){
//dd($this->where('id',$id)->first()->toArray());
     if($this->where('id',$id)->first()==null){
        return false;
      }
     // dd($array);
      
      if(array_key_exists('_token', $array)){
        unset($array['_token']);
       
      }
      if(array_key_exists('ModuleUsers', $array)){
        $array['ModuleUsers']=json_encode($array['ModuleUsers'])  ;      
      }
   

      if($this->where('id', $id)->update($array)){
        return true;
      }
      return false;
  }

  public function checkSavelvl1($class){
    $e=0;
    foreach ($class->columnMaster as $key => $value) {
    if(array_key_exists($value,$class->attributes)){
       if($e==0 and $class->attributes[$value] === null){
          $e=1;
        }
      }else{
        $e=1;
      }
    }
    return $e;
  }



}
