<?php 


namespace Backend\Configure\Modules;

use \Illuminate\Http\Request;

class UserMainController extends \App\Http\Controllers\Controller
{
 public function user_Update(Request $request, $id){
      dd($id);
    }

}