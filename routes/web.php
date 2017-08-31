<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::group([], function () {
    Route::match(['get','post'],'/',['uses'=>'IndexController@execute', 'as'=>'home']);
    Route::get('/page/{alias}',['uses'=>'PageController@execute','as'=>'page']);
    Route::auth();
});
//admin/page...portfolio...services
    Route::group(['prefix'=>'admin','middleware'=>'auth'], function () {
    //admin
        Route::get('/',function () {
            if (view()->exists('admin.index')) {
                $data = ['title'=>'Панель Админа'];
                return view('admin.index',$data);
            }

    });

        //admin/pages для роботи зі сторінками
    Route::group(['prefix'=>'pages'], function () {

        //admin/pages
        Route::get('/',['uses'=>'PagesController@execute', 'as'=>'pages']);
        //admin/pages/add
        Route::match(['get','post'],'/add',['uses'=>'PagesAddController@execute', 'as'=>'pagesAdd']);
        //admin/edit/2
        Route::match(['get','post','delete'],'/edit/{page}',['uses'=>'PagesEditController@execute','as'=>'pagesEdit']);
    });

    //admin/pages для роботи зі сторінками
    Route::group(['prefix'=>'portfolios'], function () {

        //admin/Portfolio
        Route::get('/',['uses'=>'PortfolioController@execute', 'as'=>'portfolio']);
        //admin/Portfolio/add
        Route::match(['get','post'],'/add',['uese'=>'PortfolioAddController@execute', 'as'=>'portfolioAdd']);
        //admin/Portfolio/2
        Route::match(['get','post','delete'],'/edit/{portfolio}',['uses'=>'PortfolioEditController@execute','as'=>'portfolioEdit']);
    });
});

Route::group(['prefix'=>'services'], function () {

    //admin/services
    Route::get('/',['uses'=>'ServicesController@execute', 'as'=>'services']);
    //admin/services/add
    Route::match(['get','post'],'/add',['uese'=>'ServicesAddController@execute', 'as'=>'servicesAdd']);
    //admin/services/2
    Route::match(['get','post','delete'],'/edit/{services}',['uses'=>'ServicesEditController@execute','as'=>'servicesEdit']);
});
