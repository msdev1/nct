<?php

namespace Backend;

use \Illuminate\Http\Request;

class PanelController extends \App\Http\Controllers\Controller
{

    public function __construct()
    {
        $this->user=new \BModel\User ();

    }

    public function index(Request $r){
      $nav=new \BModel\Module ();
      $data=[
        'user'=>$this->user-> getUser(),
        'nav'=>$nav->all()->toArray(),
        'test'=>$nav,
        'request'=>$r,
      ];
$email=[];
//       \Mail::send('welcome', $email, function ($message) {
//     $message->from('mitul.a.patel19@gmail.com', 'MSDyna Application');

//     $message->to('mitul.a.patel19@gmail.com');
// });
    //  dd($r->fullUrlWithQuery(['tab'=>'demo']));
      return view('Backend.Panel.home')->with('data',$data);

    }


   

    public function configMenu(Request $r){
      $data=[
        'user'=>$this->user-> getUser(),
        'form'=>new \BModel\Module (),
        'request'=>$r,
        'users'=>$this->user,
        

      ];
      return view('Backend.Panel.Configure.home')->with('data',$data);
    }
    public function module_Add_Form(){
      $data=[
        'form'=>new \BModel\Module (),
      ];
      return view('Backend.Panel.Configure.home')->with('data',$data);
    }


    public function module_Update_Form(Request $request, $id){
      $data=[
        'form'=>new \BModel\Module (),
        'r'=>$request,
        'id'=>$id
      ];
      return view('Backend.Panel.Configure.Modules.updateModuleForm')->with('data',$data);
    }

    public function module_Update(Request $request){
     $data=[
        'mod'=>new \BModel\Module (),
        'reuest'=>$request
      ];  

   

      
     $id=$request->all();

   
      $task=$data['mod']->module_update($id,$request->all());
      //dd($task);
      if($task['ok']){
      return json_encode([
        'status'=>'200',
        'msg'=>$task['msg'],
         ],true);
      }

      return json_encode([
          'status'=>'205',
          'msg'=>$task['msg'],
        ],true);
    }

    public function module_View_json(){
      $data=[
        'form'=>new \BModel\Module (),
      ];
        return view('Backend.Panel.Configure.Modules.viewModuleForm')->with('data',$data);
    }

    public function module_Add_json(){
      $data=[
        'form'=>new \BModel\Module (),
      ];
        return view('Backend.Panel.Configure.Modules.addModuleForm')->with('data',$data);
    }

    public function module_View(){

    }

    public function module_Add(Request $r){
      header('Content-Type: application/json');
      $data=[
        'mod'=>new \BModel\Module (),
      ];      
      $task=$data['mod']->module_add($r);
      if($task['ok']){
      return json_encode([
        'status'=>'200',
        'msg'=>$task['msg'],
         ],true);
      }

      return json_encode([
          'status'=>'205',
          'msg'=>$task['msg'],
        ],true);

    }
    public function module_Delete(Request $r,$id=null){
      //header('Content-Type: application/json');
      $data=[
        'mod'=>new \BModel\Module (),
        'reuest'=>$r,
      ];  

   

      
      //dd($id);

      $task=$data['mod']->module_delete($r);
      //dd($task);
      if($task['ok']){
      return json_encode([
        'status'=>'200',
        'msg'=>$task['msg'],
         ],true);
      }

      return json_encode([
          'status'=>'205',
          'msg'=>$task['msg'],
        ],true);

    }

    public function user_View_json(){
      $data=[
        'user'=>new \BModel\Module (),
      ];
        return view('Backend.Panel.Configure.Modules.viewUserForm')->with('data',$data);
    }


    public function user_Add(Request $r){
      header('Content-Type: application/json');
      $data=[
        'mod'=>new \BModel\User (),
      ];
      //dd($r->all());
      $msg=$data['mod']->massage;
      $rules=$data['mod']->rules();
      $input=$r->all();

      //dd(!array_key_exists('ModelCount',$input));
      ///module calulate Modulecount from parent count function
      if(!array_key_exists('ModelCount',$input)){
       $parent=$input['ModuleParent'];
       if(!($parent=='0')){
        $count=$data['mod']->where('id',$parent)->pluck('ModuleCount')->first();
        $count=$count+1;
        $input['ModuleCount']=$count;
      }else{
        $input['ModuleCount']=0;
      }
      }
      if(array_key_exists('ModuleUsers',$input)){
        if(is_array($input['ModuleUsers'])){
          foreach ($input['ModuleUsers'] as $key => $value) {
            $modUser[]=$this->user->where('id',$value)->pluck('UserCode')->first();
          }
          $input['ModuleUsers']=$modUser;
        }
      }

      $validator = \Validator::make($input,$rules,$msg);
      if($validator->fails()){
        $error=$validator->errors()->all();
        return json_encode([
          'status'=>'205',
          'msg'=>$error,
        ],true);
        //return redirect()->back()->with('error',$error);
        //return view('Backend.loginForm')->with('error',$error)->with('form',$user)->withInput();
      }
      $mod=new \BModel\Module();

      $array2=$mod->feedMod($input);
      $mod->feed($array2);
      $mod->checkSave();
      return json_encode([
        'status'=>'200',
        'msg'=>'Module add successfully',
      ],true);

      dd($msg);



      //return view('Backend.Panel.Configure.Modules.')->with('data',$data);
    }

    public static function nav(){

      $array=[

        [
          'SubName'=>'Company Details',
          'HasSub'=>'1',
          'SubLink'=>'site/company_details',
        ],
          //'subLink'=>,



      ];

    }


}
