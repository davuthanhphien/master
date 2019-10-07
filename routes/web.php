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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'user'],function() {

    Route::get('login', 'UserController@showLoginForm')->name('login');
    Route::post('login', 'UserController@login')->name('postLogin');

    Route::get('register', 'UserController@showRegistrationForm')->name('register');
    Route::post('register', 'UserController@register')->name('postRegister');

    Route::get('logout', 'UserController@logout')->name('logout');


});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin','middleware'=>['master']],function() {

    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

    Route::resource('/menu','MenuController');
    Route::get('/menudata/getdata','MenuController@getdata')->name('menudata.getdata');

    Route::resource('/widgets','WidgetsController');
    Route::get('/widgetsdata/getdata','WidgetsController@getdata')->name('widgetsdata.getdata');

    Route::resource('/banner','BannerController');
    Route::get('/bannerdata/getdata','BannerController@getdata')->name('bannerdata.getdata');

    Route::get('/ajaxdata/getdata','UserController@getdata')->name('userdata.getdata');
    Route::get('/roleData','UserController@getdataRole')->name('role.getdata');
    Route::resource('/user', 'UserController');

    Route::get('/roledata/getdata','RoleController@getdata')->name('roledata.getdata');
    Route::get('/permissionData','RoleController@getdataPermission')->name('permission.getdata');
    Route::resource('/role', 'RoleController');

    Route::resource('/permission', 'PermissionController');
    Route::get('/permissiondata/getdata','PermissionController@getdata')->name('permissiondata.getdata');

    Route::get('/uploadFile', 'UploadController@getUpload')->name('getUpload');
    Route::post('/upload', 'UploadController@uploadFile')->name('uploadFile');

    Route::get('/export', 'UserController@export');
    Route::get('/import', 'UserController@import');
    Route::post('/import', 'UserController@postImport');

});

Route::group(['prefix'=>'chat','middleware'=>['auth']],function (){
    Route::get('/index','ChatController@index')->name('chat.index');
    Route::get('/getUserLogin','ChatController@getUserLogin')->name('chat.getUserLogin');
    Route::get('/friend','ChatController@friend')->name('chat.friend');
    Route::get('/friendMessage/{id}','ChatController@friendMessage');
    Route::get('/notification/{id}','ChatController@notification');
    Route::post('/notification','ChatController@postNotification');
    Route::post('/typing','ChatController@postTyping');
    Route::post('/message','ChatController@message')->name('message');
    Route::post('/messageFail','ChatController@messageFail')->name('messageFail');
    Route::post('/updateMessage','ChatController@updateMessage')->name('updateMessage');
    Route::post('/deleteNotification/{id}','ChatController@deleteNotification')->name('deleteNotification');
    Route::get('/getonline','ChatController@getOnline');
    Route::post('/online','ChatController@online')->name('online');
    Route::post('/offline','ChatController@offline')->name('offline');
});





