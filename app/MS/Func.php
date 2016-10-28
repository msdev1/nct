<?php

namespace MS;

Class Func {


public static function buildModuleMenu($table){

			  $table=$table->all();

              $all=$table->toArray();
             

              if(count($all) < 1){
              	return [];
              }
              $byCount=$table->groupBy('ModuleCount')->toArray();
              $byParent=$table->groupBy('ModuleParent')->toArray();
              $level1=$byCount[0];
              foreach ($level1 as $key => $value) {
                  $value['child']=self::getChild($value['id'],$byParent);
                  if(empty($value['child'])){
                  	unset($value['child']);
                  }
                  $child[$key]=$value;

                  if( array_key_exists('child', $value)){
                  	foreach ($value['child']as $key1 => $value1) {
                    ///dd($value['child']);
                    $value1['child']=self::getChild($value1['id'],$byParent);
                    //dd($value['ModuleName']);
                    if(empty($value1['child'])){
                  	unset($value1['child']);
                  }
                    $child[$key]['child'][$key1]=$value1;
                  	}	
                  }

                  
                  
              
              }

             
             return $child;


}

public static function getChild($parent,$byParent){
	if(array_key_exists($parent, $byParent)){
                  return $byParent[$parent];
                }
                return false;
}

public static function printModuleMenu($array){

	$html='';

	$class_no_drop="test ";

	$class_drop="dropdown";

	$class_drop_ul="dropdown-menu";
	$class_drop_li="dropdown";

	$html.='<ul class="nav navbar-nav">';
	
	foreach ($array as $value) {
		
		if(array_key_exists('child', $value)){
			$html.="<li class='dropdown'>";
			$html.='<a href="'.url('backend/panel/mod/'.$value['ModuleLink']).'" class="'.$class_drop.'" data-toggle="dropdown">'.$value['ModuleName'].'<span class="caret"></span></a>';

			$html.="<ul class='".$class_drop_ul."'>";

			foreach ($value['child'] as $value2) {
				
				if(array_key_exists('child', $value2)){
					$html.="<li class='dropdown-submenu'>";	
					$html.='<a href="'.action('\\Backend\\Modules\\ModuleController@home',['mod'=>$value['ModuleLink'],'mainTab'=>$value2['ModuleLink']]).'" class="'.$class_drop.'" data-toggle="dropdown">'.$value2['ModuleName'].'<span class="caret"></span></a>';
					$html.="<ul class='".$class_drop_ul."'>";
					//var_dump($value2['child']);

					foreach ($value2['child'] as $value3) {
						$html.='<li class=""><a href="'.action('\\Backend\\Modules\\ModuleController@home',['mod'=>$value['ModuleLink'],'mainTab'=>$value2['ModuleLink'],'subTab'=>$value3['ModuleLink']]).'" class="'.$class_no_drop.'">'.$value3['ModuleName'].'</a>';		
						$html.="</li>";
					}
					$html.="</ul>";

				}else{
				$html.='<li><a href="'.$value2['ModuleLink'].'" class="'.$class_no_drop.'">'.$value2['ModuleName'].'</a>';		
				}
				$html.="</li>";
			}

			$html.="</ul>";
			

		}else{
			$html.='<li><a href="'.$value['ModuleLink'].'" class="'.$class_no_drop.'">'.$value['ModuleName'].'</a>';
			}
		$html.="</li>";
		
	}

	//dd($array);
	//dd($html);
	$html.="</ul>";
	return $html;

}

public static function breadcrumb($array){
	$html='';

	$html.='<ol class="breadcrumb container-fluid">';

	foreach ($array as $key => $value) {
		if($value == 'active' ){
			$html.='<li class="active">'.$key.'</li>';
		}else{
			$html.='<li><a href="'.$value.'">'.$key.'</a></li>';
		}
	}

	$html.='</ol>';	
	return $html;
}




}