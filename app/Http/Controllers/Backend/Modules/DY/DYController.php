<?php
namespace Backend\Modules\DY;
use \Illuminate\Http\Request;

class DYController extends \App\Http\Controllers\Controller
{
	public function index(){
		return view('Backend.Panel.Modules.DY.home');
	}

	public function home (Request $req){
		$data=[
		'request'=>$req,
		'mod'=>'dy',
		];
		return view('Backend.Panel.Modules.DY.home')->with('data',$data);
	}
}