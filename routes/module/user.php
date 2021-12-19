<?php

$RouterUser=function (){
    Route::get("login","Admin\UserController@getLogin")
    ->name("admin.user.login");
    Route::post("login","Admin\UserController@postLogin");
    Route::get("user/add","Admin\UserController@getAdd")
    ->name("admin.user.add");
    Route::post("user/add","Admin\UserController@postAdd");
    Route::post("user/check/email","Admin\UserController@checkEmail")
    ->name("admin.user.check.email");
    Route::get("user","Admin\UserController@getIndex")
    ->name("admin.user");
    Route::get("user/datatable","Admin\UserController@getDatatable")
    ->name("admin.user.datatable");
    Route::get("user/update/{id}","Admin\UserController@getUpdate")
    ->name("admin.user.update");
};