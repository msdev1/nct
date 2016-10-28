<?php

namespace BModel;


class User extends \BModel\BaseModel
{
    protected $table = 'SuperAdmin';
    protected $connection = 'master';
    protected $visible = ['FirstName', 'LastName', 'UserName','PassWord','ContactNo','eMail','LastLogin_ip','CurrentLogin_ip'
    ,'JetKey','EmailCode','id','ExtraField','Status','EmailVeryfied','CurrentLogin_status','UserCode','AccessCode'];
    protected $casts = ['Status' => 'boolean',];

    protected $fillable = [
        'FirstName', 'LastName', 'UserName','PassWord','ContactNo','eMail','LastLogin_ip','CurrentLogin_ip'
        ,'JetKey','EmailCode','ExtraField','Status','EmailVeryfied','CurrentLogin_status','UserCode','AccessCode'
    ];
    protected $hidden = [
                            'passWord', 'remember_token',
                        ];

    protected $columnMaster=[
                              'fname'=>'FirstName',
                              'lname'=>'LastName',
                              'un'=>'UserName',
                              'uc'=>'UserCode',
                              'pw'=>'PassWord',
                              'ac'=>'AccessCode',
                              'con'=>'ContactNo',
                              'email'=>'eMail',
                              'lastip'=>'LastLogin_ip',
                              'cio'=>'CurrentLogin_ip',
                              'jk'=>'JetKey',
                              'ec'=>'EmailCode',
                              'extra'=>'ExtraField',
                              'ev'=>'EmailVeryfied',
                              'cls'=>'CurrentLogin_status',
                              'st'=>'Status',
                            ];

      public $unique=['UserName','eMail'];
      public $formMaster=[
        'FirstName'=>[
          'Lable'=>'First Name',
          'Type'=>'text',
          'PlaceHolder'=>'Enter First Name',
          'value'=>'',
        ],
        'LastName'=>[
          'Lable'=>'Last Name',
          'Type'=>'text',
          'PlaceHolder'=>'Enter Last Name',
        ],
        'UserName'=>[
          'Lable'=>'User Name',
          'Type'=>'text',
          'PlaceHolder'=>'Enter User Name',
        ],
        'UserCode'=>[
          'Lable'=>'User Code',
          'Type'=>'auto.UserCode',
          'PlaceHolder'=>'Auto Genrated'
        ],
        'PassWord'=>[
          'Lable'=>'Password',
          'Type'=>'password',
          'PlaceHolder'=>'Enter Password',
        ],
        'AccessCode'=>[
          'Lable'=>'Access Code',
          'Type'=>'auto.UserAccessCode',
          'PlaceHolder'=>'Enter Password',
        ],
        'ContactNo'=>[
          'Lable'=>'Contact No.',
          'Type'=>'number',
          'PlaceHolder'=>'Enter Contact No.',
        ],
        'eMail'=>[
          'Lable'=>'Email',
          'Type'=>'email',
          'PlaceHolder'=>'Enter EMail',
        ],
        'LastLogin_ip'=>[
          'Lable'=>'Last Login IP',
          'Type'=>'auto.lLoginIp',
          'PlaceHolder'=>'Auto Genrated'
        ],
        'CurrentLogin_ip'=>[
          'Lable'=>'Current Login IP',
          'Type'=>'auto.cLoginIp',
          'PlaceHolder'=>'Auto Genrated'
        ],
        'JetKey'=>[
          'Lable'=>'JetKey',
          'Type'=>'auto.JetKey',
          'PlaceHolder'=>'Auto Genrated',
        ],
        'EmailCode'=>[
          'Lable'=>'Email Code',
          'Type'=>'auto.EmailCode',
          'PlaceHolder'=>'Auto Genrated',
        ],
        'ExtraField'=>[
          'Lable'=>'ExtraField',
          'Type'=>'json',
          'PlaceHolder'=>'Auto Genrated',
        ],
        'EmailVeryfied'=>[
          'Lable'=>'Email Verified',
          'Type'=>'radio',
          'Option'=>['Yes'=>1,'No'=>0],
        ],
        'CurrentLogin_status'=>[
          'Lable'=>'Current Login Status',
          'Type'=>'radio',
          'Option'=>['Yes'=>1,'No'=>0],]
        ,
        'Status'=>[
          'Lable'=>'Status',
          'Type'=>'radio',
          'Option'=>['Active'=>1,'Deactive'=>0],
        ],

      ];
      public $formMasterExtra=[
        'auto.UserCode'=>'autoUserCode',
        'auto.lLoginIp'=>'autolLogin',
        'auto.cLoginIp'=>'autocLogin',
        'auto.EmailCode'=>'autoEmailCode',
        'auto.UserAccessCode'=>'autoAccesscode',
      ];
      public $rules=[
        'FirstName'=>'required|string',
        'LastName'=>'required|string',
        'UserName'=>'required|string|min:6',
        'UserCode'=>'required|string',
        'PassWord'=>'required|string|min:10',
        'ContactNo'=>'required|numeric|min:10',
        'eMail'=>'required|email|',
        'LastLogin_ip'=>'required|ip',
        'CurrentLogin_ip'=>'required|ip',
        'JetKey'=>'required|',
        'EmailCode'=>'required|string',
        'ExtraField'=>'required|json',
        'EmailVeryfied'=>'required|boolean|',
        'CurrentLogin_status'=>'required|boolean|',
        'Status'=>'required|boolean|',
      ];
      public $massage=[
        'required'=>'Please enter :attribute .',
        'string'=>'Please enter valid :attribute .',
        'ip'=>'Please enter valid IP in :attribute .',
        'json'=>'Please enter valid json input in :attribute .',
        'boolean'=>'Please select valid option in :attribute .',
        'numeric'=>'Please enter mobile number (10 Digit Number without country code) in :attribute .',
        'email'=>'Please enter valid :attribute .',
      ];
      public $formMethod='post';
      public $fromAction='\Backend\SystemController@index';
    public function autoUserCode($name)
    {
      $input=$this->formMaster[$name];
      $uc=\Crypt::encrypt(str_random(6));
      $final='<div class="form-group">'
      .\Form::label($name, $input['Lable']." : ", array())
      .\Form::text($name."_disabled",$uc,['placeholder'=>$input['PlaceHolder'],'disabled'=>true,'class'=>"form-control"])
      .'<input type="hidden" name="'.$name.'" value="'.$uc.'"></div>';
      
      return $final;
    }

    public function autoAccesscode($name,$value=null){

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
        $value=$this->secret($value,true);
                                      $radio=\Form::select($name, $count, $value,["class"=>"form-control"]);
                                    }else{
                                      $radio=\Form::select($name, $count, '0',["class"=>"form-control"]);
                                    }
                                    

      //$radio=\Form::select($name, $count, '0',["class"=>"form-control"]);
      $final.=$radio;
      $final.='</div>';
      return $final;
    }
    public function autolLogin($name)
    {
      $input=$this->formMaster[$name];
      $final='<div class="form-group">'
      .\Form::label($name, $input['Lable']." : ", array())
      .\Form::text($name,$_SERVER['REMOTE_ADDR'],['placeholder'=>$input['PlaceHolder'],'disabled'=>true,'class'=>"form-control"])
      .'</div>';
      return $final;
    }

    public function autocLogin($name)
    {
      $input=$this->formMaster[$name];
      $final='<div class="form-group">'
      .\Form::label($name, $input['Lable']." : ", array())
      .\Form::text($name,$_SERVER['REMOTE_ADDR'],['placeholder'=>$input['PlaceHolder'],'disabled'=>true,'class'=>"form-control"])
      .'</div>';
      return $final;
    }

    public function autoEmailCode($name)
    {
      $input=$this->formMaster[$name];
      $final='<div class="form-group">'
      .\Form::label($name, $input['Lable']." : ", array())
      .\Form::text($name,str_random(6),['placeholder'=>$input['PlaceHolder'],'disabled'=>true,'class'=>"form-control"])
      .'</div>';
      return $final;
    }

    public function autoJetKey($name)
    {
      $input=$this->formMaster[$name];
      $final='<div class="form-group">'
      .\Form::label($name, $input['Lable']." : ", array())
      .\Form::text($this->newJetKey(),['placeholder'=>$input['PlaceHolder'],'disabled'=>true,'class'=>"form-control"])
      .'</div>';
      return $final;
    }

    public function newJetKey(){
      $jk=\Crypt::encrypt(str_random(4));
      while ($this->where('JetKey',$jk)->first() == null) {
      return $jk;
        }
        return false;

    }

    public function newEmailCode(){
      $ec=str_random(6);
      while ($this->where('EmailCode',$ec)->first() == null) {
      return $ec;
        }
        return false;
    }


    public function newUserCode(){
      $uc=str_random(6);
      while ($this->where('UserCode',$uc)->first() == null) {
      return $uc;
        }
        return false;

    }


    public function loginForm($backtend=false){
      $field=['UserName','PassWord'];
      $button=['Login'=>['value'=>'submit','class'=>'btn-success'],'Reset'=>['value'=>'reset','class'=>'btn-warning']];
      if($backtend){
        $button['Back to Website']=['value'=>'/','href'=>'/','class'=>'btn-primary'];
      }
      $this->displayForm($field,'post','\Backend\SystemController@login',$button,'btn-success');
      return true;

    }
    public function userAddForm(){
      $field=['FirstName','LastName','UserName','PassWord','UserCode','eMail','ContactNo','AccessCode','Status'];
      $button=['Add User'=>['value'=>'submit','class'=>'btn-success'],'Reset'=>['value'=>'reset','class'=>'btn-warning']];
      $this->displayForm($field,'post','\Backend\PanelController@user_Add',$button,'btn-success');
      return true;

    }

    public function userUpdateForm($id=null){
    $field=['FirstName','LastName','UserName','PassWord','eMail','ContactNo','AccessCode','Status'];
    $button=['Save'=>['value'=>'submit','class'=>'btn-success'],'Reset'=>['value'=>'reset','class'=>'btn-warning']];
    $this->displayForm($field,'post','\Backend\Configure\Modules\UserMainController@user_Update',$button,'btn-success','updateUser',$id);
    return true;

}
    public function login($r){
        $user=$this->where('UserName',$r->input('UserName'));
        if($user->first() !=null){
          //$this->secret($user->pluck('PassWord')->first(),true)
//  dd($user->pluck('Status')->first());
          if($user->pluck('Status')->first()=='0' or $user->pluck('Status')->first()==0 ){
          $error=['User is Disabled Please Contact your vendor for more details.'];
          return $error;
            
          }
          if($r->input('PassWord') === $this->secret($user->pluck('PassWord')->first(),true)){
        //  if($r->input('PassWord') === \Crypt::decrypt($user->pluck('PassWord')->first())){


          if($user->pluck('CurrentLogin_status')->first()==0){
            return $this->loginUser($user->pluck('UserCode')->first());
          }else{

            $error=['Your Session expired from'.$user->pluck('CurrentLogin_ip')->first().' .',$user->pluck('CurrentLogin_ip')->first().' logged out Successfully'];
            $this->changeTheJetKey($user->pluck('UserCode')->first());
            return $this->loginUser($user->pluck('UserCode')->first());
            //return $error;
          }


          }else{
            $error=['Enter Valid Username & Password'];
            return $error;
          }
        }else{
          $error=['Enter Valid Username or Password'];
          return $error;
        }


    }

    public function changeTheJetKey($uc){

      $jk=$this->newJetKey();
      $array=[
        'CurrentLogin_status'=>0,
        'CurrentLogin_ip'=>$_SERVER['REMOTE_ADDR'],
        'LastLogin_ip'=>$this->where('UserCode',$uc)->pluck('CurrentLogin_ip')->first(),
        'JetKey'=>$jk,
      ];
      $this->where('UserCode',$uc)->update($array);
      return true;
    }

    public function logout(){
    //  dd(\Session::has('MSUSER'));
      if(\Session::has('MSUSER')){
        return $this->logoutUser();

      }
      return false;
    }

    public function loginUser($uc){
      $array=[
        'CurrentLogin_status'=>1,
        'CurrentLogin_ip'=>$_SERVER['REMOTE_ADDR'],
        'LastLogin_ip'=>$this->where('UserCode',$uc)->pluck('CurrentLogin_ip')->first(),
      ];
      \Session::put('MSUSER',$this->newUserCookie($uc));
      $this->where('UserCode',$uc)->update($array);
      return true;


    }

    public function logoutUser(){
      $array=[
        'CurrentLogin_status'=>0,
        'LastLogin_ip'=>$_SERVER['REMOTE_ADDR'],
      ];

      $cookie=\Session::get('MSUSER');

      $jetkey=$this->decodeJetKey($cookie);
      $uc=$this->where('JetKey',$jetkey)->pluck('UserCode')->first();

      if($uc!=null){
      // dd(\Session::get('MSUSER'));
      \Session::flush();
    //  dd();
        if($this->where('UserCode',$uc)->update($array) and \Session::has('MSUSER')==false){

            return true;
        }

      }
      return false;

    }

    public function getCurrentLoginIp($uc){
      return $this->where('UserCode',$uc)->pluck('CurrentLogin_ip')->first();
    }

    public function decodeJetKey($key){
      $key=$this->secret($key,true);
      //$key=\Crypt::decrypt($key);
      $fkey=explode('-',$key)[1];
      return $fkey;
    }

    public function getUser(){
      $r=\Session::get('MSUSER');
      $user=$this->where('JetKey',$this->decodeJetKey($r))->first();
      return [
        'id'=>$user->id,
        'FirstName'=>$user->FirstName,
        'LastName'=>$user->LastName,
        'eMail'=>$user->eMail,
        'ContactNo'=>$user->ContactNo,
        'CurrentLogin_ip'=>$user->CurrentLogin_ip,
        'UserName'=>$user->UserName,
        'AccessCode'=>$this->secret($user->AccessCode,true),
        'UserCode'=>$user->UserCode,
      ];

    }

    public function checkLogin(){
    //  dd(\Session::get('MSUSER'));
      $r=\Session::get('MSUSER');
      //dd($r);
      if($r!=null){
        $cookie=$this->secret($r,true);
        $jetkey=explode('-',$cookie)[1];
        if($this->where('JetKey',$jetkey)->pluck('UserCode')->first()==null){
        return false;
        }
        if($this->where('JetKey',$jetkey)->pluck('Status')->first()== 0 or $this->where('JetKey',$jetkey)->pluck('Status')->first()=='0'){
          return false;
        }

        return true;
        

      }else{
        return false;
      }
    }

    public function newUserCookie($uc){
      $cookie=$this->secret(str_random(4)."-".$this->where('UserCode',$uc)->pluck('JetKey')->first()."-".str_random(4));
      return $cookie;
    }

  public function checkSave()
    {

        $e=0;

        foreach ($this->columnMaster as $key => $value) {
        if(array_key_exists($value,$this->attributes)){
           if($e==0 and $this->attributes[$value] === null){
              $e=1;
            }
          }else{
            $e=1;
          }
        }

        if($e==0){
          if($this->where('UserName',$this->attributes['UserName'])->first() == null
          and $this->where('eMail',$this->attributes['eMail'])->first() == null ){
            $this->save();
          return true;
          }
        return false;
        }else{
          return false;
        }
     }
}
