<?php


 Route::get('/',
[
    'as' => 'Backend.Modules.DY.GET', 'uses' => '\\Backend\\Modules\\DY\\DYController@home',
]);


 Route::post('/basic/save',
[
    'as' => 'Backend.Modules.DY.GET', 'uses' => '\\Backend\\Modules\\DY\\BasicSettings\\MainController@save',
]);


 Route::get('/basic/batch',
[
    'as' => 'Backend.Modules.DY.GET', 'uses' => '\\Backend\\Modules\\DY\\BasicSettings\\MainController@batchRefresh',
]);




