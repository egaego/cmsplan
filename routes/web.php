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
    return redirect('login');
});

/**
 * Admin Routes
 */
Auth::routes();
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('/', ['as' => 'admin', 'uses' => 'Admin\DashboardController@index']);
    
    Route::get('/user/profile', ['as' => 'user.profile', 'uses' => 'Admin\UserController@profile']);
    Route::post('/user/profile', ['as' => 'user.profile', 'uses' => 'Admin\UserController@updateProfile']);
    
    Route::get('/concept/data', ['as' => 'concept.data', 'uses' => 'Admin\\ConceptController@listIndex']);
	Route::resource('/concept', 'Admin\\ConceptController');
    
    Route::get('/user/data', ['as' => 'user.data', 'uses' => 'Admin\\UserController@listIndex']);
	Route::resource('/user', 'Admin\\UserController');
    
    Route::get('/user-app/data', ['as' => 'user-app.data', 'uses' => 'Admin\\UserAppController@listIndex']);
	Route::resource('/user-app', 'Admin\\UserAppController');
    
    Route::get('/user-relation/data', ['as' => 'user-relation.data', 'uses' => 'Admin\\UserRelationController@listIndex']);
	Route::resource('/user-relation', 'Admin\\UserRelationController');
    
    Route::get('/procedure/data', ['as' => 'procedure.data', 'uses' => 'Admin\\ProcedureController@listIndex']);
	Route::resource('/procedure', 'Admin\\ProcedureController');
    
    Route::get('/term-of-use/data', ['as' => 'term-of-use.data', 'uses' => 'Admin\\TermOfUseController@listIndex']);
	Route::resource('/term-of-use', 'Admin\\TermOfUseController');
    
    Route::get('/about-us/data', ['as' => 'about-us.data', 'uses' => 'Admin\\AboutUsController@listIndex']);
	Route::resource('/about-us', 'Admin\\AboutUsController');
    
    Route::get('/content/data/{id}', ['as' => 'content.data', 'uses' => 'Admin\\ContentController@listIndex']);
    Route::get('/content/{id}', ['as' => 'content.show', 'uses' => 'Admin\\ContentController@show']);
    
    Route::get('/content-detail/data/{id}', ['as' => 'content-detail.data', 'uses' => 'Admin\\ContentDetailController@listIndex']);
    Route::get('/content-detail/{id}', ['as' => 'content-detail.show', 'uses' => 'Admin\\ContentDetailController@show']);
    
    Route::get('/content-detail-list/data/{id}', ['as' => 'content-detail-list.data', 'uses' => 'Admin\\ContentDetailListController@listIndex']);
    Route::get('/content-detail-list/{id}', ['as' => 'content-detail-list.show', 'uses' => 'Admin\\ContentDetailListController@show']);
});