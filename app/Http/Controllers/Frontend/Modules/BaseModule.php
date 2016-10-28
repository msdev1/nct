<?php
namespace Frontend\Modules;

class BaseModule extends \Frontend\Modules\Module
{

public static function view($data,$targetPage){
		
   	foreach ($data as $key => $value) {
   		$data[$key]=$value;
   	}

      return view($targetPage)->with('data',$data);
	}


}