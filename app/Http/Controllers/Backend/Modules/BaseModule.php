<?php
namespace Backend\Modules;

class BaseModule extends \Backend\Modules\Module
{
	public static function batch($model,$targetPage){
		
	$data=[
       		'table'=>new $model (),
   		  ];
      return view($targetPage)->with('data',$data);
	}

	public static function updateBatch($model,$targetPage){
		$data=[
       		'table'=>new $model (),
   		  ];
		return view($model,$targetPage)->with('data',$data);
	}

	public static function add($model,$targetPage){
		$data=[
       		'form'=>new $model (),
   		  ];
		return view($model,$targetPage)->with('data',$data);
		
	}

	public static function edit($model,$targetPage,$id){
		$data=[
       		'form'=>new $model (),
       		'id'=>$id
   		  ];
		return view($model,$targetPage)->with('data',$data);
	}

	public static function save($model,$request,$modelMethod){
		
		header('Content-Type: application/json');
     	$data=[
        		'model'=>new $model (),
     	 	  ];

      	$task=$data['model']->$modelMethod($request);
      	if($task['ok']){

      	return response()->json([
        'status'=>'200',
        'msg'=>$task['msg']
         ]);
      	
      	}

      	return response()->json([
        'status'=>'205',
        'msg'=>$task['msg']
         ]);

	}

	public static function delete(){
		
	}



	

}
