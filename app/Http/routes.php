<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//   echo database_path('master'.DS.'msERP_master_data');
// //return view('welcome');
// });



require_once (app_path().DS."Http".DS."Controllers".DS."Frontend".DS."routes.php");

Route::group(['prefix' => 'backend'], function () {
  require_once (app_path().DS."Http".DS."Controllers".DS."Backend".DS."routes.php");
});
