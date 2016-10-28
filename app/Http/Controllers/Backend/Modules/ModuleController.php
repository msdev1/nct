<?php
namespace Backend\Modules;

class ModuleController extends \App\Http\Controllers\Controller
{


	public function home (){

		$mod=strtoupper($_GET['mod']);
		//unset($_GET['mod']);
		switch (strtolower($mod)) {
			case 'dy':
			return redirect()->action("\\Backend\\Modules\\".$mod."\\".$mod."Controller@home", $_GET);	
			break;
			case 'nam':
			return redirect()->action("\\Backend\\Modules\\".$mod."\\".$mod."Controller@home", $_GET);	
			break;
			case 'mom':
			return redirect()->action("\\Backend\\Modules\\".$mod."\\".$mod."Controller@home", $_GET);	
			break;
			case 'em':
			return redirect()->action("\\Backend\\Modules\\".$mod."\\".$mod."Controller@home", $_GET);	
			break;		
			default:
				# code...
				break;
		}
	}
}