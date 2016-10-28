<?php

namespace Backend;

use \App\Model\Backend\HolderCode;
use \Illuminate\Http\Request;

class SystemController extends \App\Http\Controllers\Controller
{
    protected $app;
    public $user;
    public function __construct()
    {
      $user=new \BModel\User ();
    }

    public function panel(Request $request){
      $user= new \BModel\User ();
      $user->checkLogin();
      if($user->checkLogin()){
      return view('Backend.Panel.home');
      }
      $error=['Please Login First to Continue'];
      return redirect()->action('\Backend\SystemController@loginForm')->with('error',$error);
    }

    public function loginForm(Request $r ){

      $user= new \BModel\User ();
    //  dd($user->checkLogin());
      if($user->checkLogin()){

      return redirect()->action('\Backend\PanelController@index');
      //return view('Backend.Panel.home');
      }
      return view('Backend.loginForm')->with('form',$user);
    }

    public function index(Request $request){
      $user=new \BModel\User ();
      if($user->checkLogin()){
        $msg=['Your are Already Logged in'];

        return redirect()->action('\Backend\PanelController@index')->with('msg',$msg);
      //return view('Backend.Panel.home');
      }
      $error=['Please Login First to Continue'];
      return redirect()->action('\Backend\SystemController@loginForm')->with('error',$error);


    }

    public function logout(){
      $user= new \BModel\User ();
      //var_dump(\Session::get('MSUSER'));
      //dd($user->logout());
      if($user->checkLogin()){
        if($user->logout()){
          $error=['You are Successfully Logged out'];
          return redirect()->action('\Backend\SystemController@loginForm')->with('error',$error);
        }else{
          $error=["You are not Successfully Logged out. Please try again."];
          return redirect()->action('\Backend\SystemController@loginForm')->with('error',$error);
        }
      }else{
        $error=["You are not Logged in. Login First."];
        return redirect()->action('\Backend\SystemController@loginForm')->with('error',$error);
      }



    }

    public function login(Request $r){

      $user= new \BModel\User ();

      $rules=[
       'UserName' => 'bail|required|max:255',
       'PassWord' => 'required|min:10',
      ];
      //dd($user->rules(['UserName','PassWord']));
      $msg=$user->massage;
      $rules=$user->rules(['UserName','PassWord']);
       $validator = \Validator::make($r->all(),$rules,$msg);

       if($validator->fails()){
         $error=$validator->errors()->all();
         return redirect()->back()->with('error',$error)->with('form',$user);
         //return view('Backend.loginForm')->with('error',$error)->with('form',$user)->withInput();
       }
       $login=$user->login($r);

       if(gettype($login)=='boolean'){
        // dd($login);
        $msg=['Your are Logged in'];
        $email=[
          "user"=>$user->getUser()
        ];
              /*\Mail::send('welcome', $email, function ($message) use ($email) {
            $message->from('mitul.a.patel19@gmail.com', 'MSDyna Application');
          //  dd($email['user']['eMail']);
            $message->to($email['user']['eMail'],'Sign In Notification');
        });*/
         return redirect()->action('\Backend\PanelController@index')->with('msg',$msg);
       }elseif(is_array($login)){
         return redirect()->back()->with('error',$login)->with('form',$user);
       }else{

       }
    }


}
