<?php

$ns="\\Frontend\\";
Route::get('/',
[
    'as' => 'frontend.index.get', 'uses' => $ns.'Modules\DY\MainController@index',
]
);