<?php
namespace Frontend\Modules\DY;

use BModel\Modules\DY\BasicSettings as BasicSettings;

class MainController extends \App\Http\Controllers\Controller
{	

	public function __construct (){
		$this->engine=new \Frontend\Modules\DY\DY ();
		
	}

	public function index(){

		$data=[
		'web'=>new BasicSettings ()
		];
		$val=$data['web']->all()->first();
		if($val!=null){
		$data['web']=$val->toArray();	
		}else{
			$data['web']=[
			'SiteTitle'=>'Default Title',
			'Keywords'=>'Defailt,keyword',
			'LogoPath'=>'images/client/companyLogo_small_1.png',
			'CopywriteText'=>'Default copyright text',
			];
		}
		

		return $this->engine->view($data,'Frontend.Modules.DY.index');
		
	}


}