<?php

namespace MSModel;

/**
 * Million Solution Laravel Model Addon class
 */
class Comman extends Base
{


  function __construct()
  {
    # code...
  }

  public static function buildForm($model,$custom=0,$array=[]){
    $formMaster=$model->formMaster;
    //dd(get_class($model)."");

    if($custom){
        //$array=array_flip($array);
    //  dd($array);
    //  print_r(array_diff_assoc($array,$model->formMaster));
      //dd($model->formMaster);

      foreach ($array as $key=>$value) {
        //dd($key);
        if(array_key_exists($value,$formMaster)){
          $formMasterCustom[$value]=$formMaster[$value];
        }

      }

      $formMaster=$formMasterCustom;
      //dd($array);

    }
    if($model->id !=null){
      $val=[];
      $val1=$model->where('id',$model->id)->first();
      if($val1!=null){
        $val=$model->where('id',$model->id)->first()->toArray();
      }
      
    }else{
      $val=[];
    }


   // dd($formMaster);


    foreach ($formMaster as $key => $value) {

      if($model->id !=null && array_key_exists($key, $val)){
        $value['value']=$val[$key];
        //dd($value)        ;
       }else{
        $value['value']='';

       }

      switch ($value['Type']) {
        case 'text':
            $form[$key]=\Form::label($key, $value['Lable']." : ", array()).\Form::text($key,$value['value'],['placeholder'=>$value['PlaceHolder'],'class'=>"form-control",]);
            break;
        case 'hidden':
            $form[$key]=\Form::label($key, $value['Lable']." : ", array()).\Form::text($key."_disable",$value['value'],['placeholder'=>$value['PlaceHolder'],'class'=>"form-control ","disabled"]);
            $form[$key].=\Form::hidden($key,$value['value'],['class'=>"form-control "]);
            break;
        case 'number':
            $form[$key]=\Form::label($key, $value['Lable']." : ", array()).\Form::number($key,$value['value'],['placeholder'=>$value['PlaceHolder'],'class'=>"form-control"]);
            break;
        case 'password':
            $form[$key]=\Form::label($key, $value['Lable']." : ", array()).\Form::password($key,['placeholder'=>$value['PlaceHolder'],'class'=>"form-control"]);
            break;
        case 'email':
            $form[$key]=\Form::label($key, $value['Lable']." : ", array()).\Form::email($key,$value['value'],['placeholder'=>$value['PlaceHolder'],'class'=>"form-control"]);
            break;

        case 'json':
                $form[$key]=\Form::label($key, $value['Lable']." : ", array()).\Form::text($key."[]",null,['placeholder'=>$value['PlaceHolder'],'class'=>"form-control"]);
                break;

        case 'radio':
            $radio=\Form::label($key, $value['Lable']." : ", array());
            foreach ($value['Option'] as $key2 => $value2) {

              if(array_key_exists($key, $val) && $value2 == $val[$key] ){

              $radio.=
              \Form::label($key, $key2, array()).\Form::radio($key, $value2,$value2,['class'=>" " ,"checked"=>"checked"]);  
              }else{
              $radio.=
              \Form::label($key, $key2, array()).\Form::radio($key, $value2,$value2,['class'=>" "]);  
              }
              
            }
            $form[$key]=$radio;

        default:
      //  dd($model->formMasterExtra);
          if(array_key_exists($value['Type'],$model->formMasterExtra)){
            if(method_exists ( $model , $model->formMasterExtra[$value['Type']])){
                $function=$model->formMasterExtra[$value['Type']];
                
               if(array_key_exists($key, $val)){

                $form[$key]=$model->$function($key,$val[$key]);
               }else{
                $form[$key]=$model->$function($key);
               }
                

              }
            }
            break;
            }
      }

      return $form;
}

public static function printForm($form,$method,$action,$button='submit',$btncolor='',$formid='msDyna_form'){
    $final=\Form::open(array('action' =>$action,'method' =>$method,'id'=>$formid));
    $final.='<div class="panel-body" >';
  foreach ($form as $key => $value) {
    $final.= '<div class="form-group">'.$value."</div><br>";
  }
$final.='</div>';
$final.= "<div class='panel-footer btn-group btn-group-justified'>  ";
$btn_prefix='<a class="btn-group" role="group" >';
$btn_perfix='</a>';
  if(is_array($button)){
    foreach ($button as $key2 => $value2) {
      if(is_array($value2)){
        if($value2['value']=='submit'){
              $final.= $btn_prefix.\Form::submit($key2,['class'=>'btn '.$value2['class']]).$btn_perfix;
        }
          elseif ($value2['value']=='reset') {
              $final.= $btn_prefix.\Form::reset($key2,['class'=>'btn '.$value2['class']]).$btn_perfix;
          }
        else{

              $final.= "<a class ='btn-group' href='".$value2['value']."'>".\Form::button($key2,['class'=>'btn '.$value2['class'],'href'=>$value2['value']])."</a>";
        }

      }else{
        if($value2=='submit'){
              $final.= $btn_prefix.\Form::submit($key2,['class'=>'btn '.$btncolor]).$btn_perfix;
        }
          elseif ($value2=='reset') {
              $final.= $btn_prefix.\Form::reset($key2,['class'=>'btn '.$btncolor]).$btn_perfix;
          }else{
              $final.= "<a class ='btn-group' href='".$value2."'>".\Form::button($key2,['class'=>'btn '.$btncolor,'href'=>$value2])."</a>";
          }
      }

    }
  }else{
      if($button=='submit'){
          $final.= $btn_prefix.\Form::submit($button,['class'=>'btn '.$btncolor]).$btn_perfix;
        }
      elseif ($button=='reset') {
          $final.= $btn_prefix.\Form::reset($button,['class'=>'btn '.$btncolor]).$btn_perfix;
      }else{
        $final.= "<a class ='btn-group' href='".$value2."'>".\Form::button($button,['class'=>'btn '.$btncolor])."</a>";
      }

  }

$final.= "</div>";



  $final.= \Form::close();
  return $final;
}

public static function view($final){
  echo $final;
  return true;
}

}
