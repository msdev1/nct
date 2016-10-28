<?php

/*
|--------------------------------------------------------------------------
| Application Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the Backend routes for an application.
| It is a breeze. Simply tell MS-Dyna the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$ns="\\Backend\\";
Route::get('/',
[
    'as' => 'backend.index.get', 'uses' => $ns.'SystemController@index',
]
);

Route::get('login',
[
    'as' => 'backend.login.get', 'uses' => $ns.'SystemController@loginForm',
]);

Route::post('login',
[
    'as' => 'backend.login.post', 'uses' => $ns.'SystemController@login',
]
);


Route::get('logout',
[
    'as' => 'backend.logout.get', 'uses' => $ns.'SystemController@logout',
]);





Route::group(['middleware' => 'bpanel'], function () {



  Route::group(['prefix' => 'panel'], function () {

    Route::group(['prefix' => 'mod'], function () {
        

        require_once (app_path().DS."Http".DS."Controllers".DS."Backend".DS."Modules".DS."routes.php");
       // require_once (app_path().DS."Http".DS."Controllers".DS."Backend".DS."Modules".DS."DY".DS."routes.php");
        

        Route::group(['prefix' => 'nam'], function () {
        require_once (app_path().DS."Http".DS."Controllers".DS."Backend".DS."Modules".DS."NAM".DS."routes.php");
        });  

        Route::group(['prefix' => 'mom'], function () {
        require_once (app_path().DS."Http".DS."Controllers".DS."Backend".DS."Modules".DS."MOM".DS."routes.php");
        });  
        
        Route::group(['prefix' => 'em'], function () {
        require_once (app_path().DS."Http".DS."Controllers".DS."Backend".DS."Modules".DS."EM".DS."routes.php");
        });  
        
         
  

    });   

    Route::get('/',
    [
        'as' => 'backend.panel', 'uses' =>'\\Backend\\PanelController@index',
    ]);

Route::group(['prefix'=>'config'],function (){
    Route::get('/',
    [
        'as' => 'backend.panel.config', 'uses' =>'\\Backend\\PanelController@configMenu',
    ]);


    Route::get('/module/api/view',
    [
        'as' => 'backend.panel.config', 'uses' =>'\\Backend\\PanelController@module_View_json',
    ]);

    Route::get('/module/api/add',
    [
        'as' => 'backend.panel.config', 'uses' =>'\\Backend\\PanelController@module_Add_json',
    ]);


    Route::match(['post'],'/module/add',
    [
        'as' => 'backend.panel.config', 'uses' =>'\\Backend\\PanelController@module_Add',
    ]);

    Route::match(['get'],'/module/delete',
    [
        'as' => 'backend.panel.config', 'uses' =>'\\Backend\\PanelController@module_Delete',
    ]);

    Route::match(['post'],'/module/update',
    [
        'as' => 'backend.panel.config.module.update', 'uses' =>'\\Backend\\PanelController@module_Update',
    ]);

    Route::match(['get'],'/module/update/{id}',
    [
        'as' => 'backend.panel.config', 'uses' =>'\\Backend\\PanelController@module_Update_Form',
    ]);

    Route::match(['post','patch'],'/module/view',
    [
        'as' => 'backend.panel.config', 'uses' =>'\\Backend\\PanelController@module_View',
    ]);

    Route::match(['post','patch'],'/module/edit',
    [
        'as' => 'backend.panel.config', 'uses' =>'\\Backend\\PanelController@module_Edit',
    ]);

    Route::get('/user/api/view',
    [
        'as' => 'backend.panel.config', 'uses' =>'\\Backend\\PanelController@user_View_json',
    ]);


    Route::match(['post'],'/user/add',
    [
        'as' => 'backend.panel.config', 'uses' =>'\\Backend\\PanelController@user_Add',
    ]);

    Route::match(['get'],'/user/update/{id?}',
    [
        'as' => 'backend.panel.config', 'uses' =>'\\Backend\\Configure\\Modules\\UserMainController@user_Update',
    ]);
});

    Route::group(['prefix'=>'module'],function (){
//////////////////////
//SiteModule'////////
////////////////////
      Route::group(['prefix'=>'site'],function (){
        $ns="\\Backend\\Module\\Site\\BaseController@";
        Route::get('/',
        [
            'as' => 'module.site', 'uses' => $ns.'index',
        ]);


        Route::get('/company_details',
        [
            'as' => 'module.site.company_details', 'uses' => $ns.'companyDetails',
        ]);





      });



    });


    Route::get('logout',function(){return redirect()->action('\Backend\SystemController@logout');});


  });


});
