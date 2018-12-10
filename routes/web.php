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

Route::get('my-theme', function () {
    return view('welcome2');
});

//Backend

//Login
Route::get('admin', [
    'as'    => 'backend.auth.login',
    'uses'  => 'backend\AuthController@login'
]);

Route::post('admin', [
    'as'    => 'backend.auth.login',
    'uses'  => 'backend\AuthController@processLogin'
]);

Route::group(['middleware'  => 'isLogin'], function (){
    Route::group(['prefix'  => 'admin'], function (){

        //Projects
        Route::group(['prefix' => 'projects'], function (){
            Route::get('index', [
                'as'    => 'admin.projects.index',
                'uses'  => 'backend\ProjectController@index'
            ]);
        });

        //Admin Account
        Route::group(['prefix' => 'admin_account'], function (){
            Route::get('index', [
                'as'    => 'admin.admin_account.index',
                'uses'  =>'backend\AdminController@index'
            ]);

            Route::group(['middleware'  => 'isSuperAdmin'], function (){
                Route::get('add', [
                    'as'    => 'admin.admin_account.add',
                    'uses'  => 'backend\AdminController@add'
                ]);

                Route::post('add', [
                    'as'    => 'admin.admin_account.add',
                    'uses'  => 'backend\AdminController@processAdd'
                ]);

                Route::get('delete/{id}', [
                    'as'    => 'admin.admin_account.delete',
                    'uses'  => 'backend\AdminController@delete'
                ]);
            });
        });

        //User Account
        Route::group(['prefix' => 'user_account'], function (){
            Route::get('index', [
                'as'    => 'admin.user_account.index',
                'uses'  => 'backend\UserController@index'
            ]);

            Route::get('change_status/{id}', [
                'as'    => 'admin.user_account.change_status',
                'uses'  => 'backend\UserController@change_status'
            ]);
        });

        //My Profile
        Route::group(['prefix' => 'my_profile'], function (){
            Route::get('index', [
                'as'    => 'admin.my_profile.index',
                'uses'   => 'backend\AdminController@my_profile'
            ]);
        });

        //Logout
        Route::post('/logout', [
            'as'   => 'backend.auth.logout',
            'uses' => 'backend\AuthController@logout'
        ]);

        Route::get('/logout', function (){
            return abort(404);
        });
    });
});


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
