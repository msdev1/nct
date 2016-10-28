<?php
namespace Backend\Modules\DY\BasicSettings;
use \Illuminate\Http\Request;
class MainController extends \App\Http\Controllers\Controller
{

	public function __construct (){
		$this->engine=new \Backend\Modules\DY\DY ();
		$this->module='\Backend\Modules\BaseModule';
		$this->model=$this->engine->BasicSettings;

		


	}

	public function save(Request $request){
			$model='\\BModel\\Modules\\DY\\BasicSettings';
			$modelMethod='DBupdate';
			return $this->engine->save($model,$request,$modelMethod);
	}

	

	public function batch(){
		$model=$this->model;
		$targetPage="Backend.Panel.Modules.".$this->engine->code().".BasicSettings.batch";
		$class=new $this->module ();
		return $class::batch($model,$targetPage);
		
		//dd($class::batch($model,$targetPage));
		//return ;
	}
	
	public function batchRefresh(){

		$model=$this->model;
		$targetPage="Backend.Panel.Modules.".$this->engine->code().".BasicSettings.batch";
		$class=new $this->module ();
		return $class::batch($model,$targetPage);
		
		//dd($class::batch($model,$targetPage));
		//return ;
	}	

	public function upadateBatch(){
		$model=$this->model;
		$targetPage="Backend.Panel.Modules.".$this->engine->code().".BasicSettings.batch";
		//return $this->module::updateBatch($model,$targetPage);
	}

	public function edit($id){
		$model=$this->model;
		$targetPage="Backend.Modules.".$this->engine->code().".BasicSettings.batch";
		//return $this->module::edit($model,$targetPage);
	}

	// public function save(Request $r){
	// 	$model=$this->model;
	// 	$targetPage="Backend.Modules.".$this->engine->code().".BasicSettings.batch";
	// 	$modelMethod='module_save';
	// 	//return $this->module::save($model,$r,$modelMethod);
	// }

}
