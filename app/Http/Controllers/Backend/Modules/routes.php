<?php

Route::group(['prefix' => 'dy'], function () {
 
        require_once (app_path().DS."Http".DS."Controllers".DS."Backend".DS."Modules".DS."DY".DS."routes.php");
 
  });


  Route::get('/home',
[
    'as' => 'Backend.Modules', 'uses' => '\\Backend\\Modules\\ModuleController@home',
]);



