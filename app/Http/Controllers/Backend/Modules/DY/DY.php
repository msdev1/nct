<?php
namespace Backend\Modules\DY;

class DY extends \Backend\Modules\BaseModule
{	

	public static $moduleCode="DY";

	public $request;
	public function __construct ($request=null){
		$this->model="\\BModel\\Modules\\".Self::$moduleCode."\\MainModel";
		$this->BasicSettings="\\BModel\\Modules\\".Self::$moduleCode."\\BasicSettings";
		$this->request=$request;
		if($request!=null){
			$this->request=$request;
		}
	}

	public function code(){
		return Self::$moduleCode;
	}





}
