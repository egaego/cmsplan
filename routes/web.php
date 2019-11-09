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

Route::get('/', 'Web\\SiteController@index');

Route::get('/register-relation/{token}', 'Web\\SiteController@registerRequest');
Route::post('/register-relation', 'Web\\SiteController@proccessRegisterRequest');
Route::get('/reset-your-password/{token}', 'Web\\SiteController@resetPassword');
Route::post('/reset-your-password/{token}', 'Web\\SiteController@proccessResetPassword');
Route::get('/transaction-confirmation/{token}', 'Web\\SiteController@transactionConfirmation');
Route::post('/transaction-confirmation', 'Web\\SiteController@proccessTransactionConfirmation');

Route::get('/success', 'Web\\SiteController@success');

Route::get('/support', 'Web\\SiteController@support');

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
    Route::get('/concept/user-data/{userRelationId}', ['as' => 'concept.user-data', 'uses' => 'Admin\\UserRelationController@listConceptsIndex']);
	Route::resource('/user-relation', 'Admin\\UserRelationController');
    
    Route::get('/procedure/data', ['as' => 'procedure.data', 'uses' => 'Admin\\ProcedureController@listIndex']);
	Route::resource('/procedure', 'Admin\\ProcedureController');
    
    Route::get('/term-of-use/data', ['as' => 'term-of-use.data', 'uses' => 'Admin\\TermOfUseController@listIndex']);
	Route::resource('/term-of-use', 'Admin\\TermOfUseController');
    
    Route::get('/privacy-policy/data', ['as' => 'privacy-policy.data', 'uses' => 'Admin\\PrivacyPolicyController@listIndex']);
	Route::resource('/privacy-policy', 'Admin\\PrivacyPolicyController');
    
    Route::get('/about-us/data', ['as' => 'about-us.data', 'uses' => 'Admin\\AboutUsController@listIndex']);
	Route::resource('/about-us', 'Admin\\AboutUsController');
    
    Route::get('/content/data/{id}/{userRelationId}', ['as' => 'content.data', 'uses' => 'Admin\\ContentController@listIndex']);
    Route::get('/content/{id}/{userRelationId}', ['as' => 'content.index', 'uses' => 'Admin\\ContentController@index']);
    Route::get('/content/{id}', ['as' => 'content.show', 'uses' => 'Admin\\ContentController@show']);
    
    Route::get('/content-detail/data/{id}', ['as' => 'content-detail.data', 'uses' => 'Admin\\ContentDetailController@listIndex']);
    Route::get('/content-detail/{id}', ['as' => 'content-detail.show', 'uses' => 'Admin\\ContentDetailController@show']);
    
    Route::get('/content-detail-list/data/{id}', ['as' => 'content-detail-list.data', 'uses' => 'Admin\\ContentDetailListController@listIndex']);
    Route::get('/content-detail-list/{id}', ['as' => 'content-detail-list.show', 'uses' => 'Admin\\ContentDetailListController@show']);
    
    Route::get('/vendor/data', ['as' => 'vendor.data', 'uses' => 'Admin\\VendorController@listIndex']);
    Route::resource('/vendor', 'Admin\\VendorController');
    
    Route::get('/gallery/data', ['as' => 'gallery.data', 'uses' => 'Admin\\GalleryController@listIndex']);
    Route::resource('/gallery', 'Admin\\GalleryController');
    
    Route::group(['prefix' =>'vendor-detail'], function() {
        Route::get('/data/{id}', ['as' => 'vendor-detail.data', 'uses' => 'Admin\\VendorDetailController@listIndex']);
        Route::get('/create/{vendorId}', ['as' => 'vendor-detail.create', 'uses' => 'Admin\\VendorDetailController@create']);
        Route::post('/create/{vendorId}', ['as' => 'vendor-detail.store', 'uses' => 'Admin\\VendorDetailController@store']);
        Route::get('/{id}/edit', ['as' => 'vendor-detail.edit', 'uses' => 'Admin\\VendorDetailController@edit']);
        Route::patch('/{id}', ['as' => 'vendor-detail.update', 'uses' => 'Admin\\VendorDetailController@update']);
        Route::delete('/{id}', ['as' => 'vendor-detail.delete', 'uses' => 'Admin\\VendorDetailController@delete']);
    });

    Route::group(['prefix' =>'vendor-voucher'], function() {
        Route::get('/data/{id}', ['as' => 'vendor-voucher.data', 'uses' => 'Admin\\VendorVoucherController@listIndex']);
        Route::get('/create/{vendorId}', ['as' => 'vendor-voucher.create', 'uses' => 'Admin\\VendorVoucherController@create']);
        Route::post('/create/{vendorId}', ['as' => 'vendor-voucher.store', 'uses' => 'Admin\\VendorVoucherController@store']);
        Route::get('/{id}/edit', ['as' => 'vendor-voucher.edit', 'uses' => 'Admin\\VendorVoucherController@edit']);
        Route::patch('/{id}', ['as' => 'vendor-voucher.update', 'uses' => 'Admin\\VendorVoucherController@update']);
        Route::delete('/{id}', ['as' => 'vendor-voucher.delete', 'uses' => 'Admin\\VendorVoucherController@delete']);
    });

    Route::group(['prefix' =>'vendor-package'], function() {
        Route::get('/data/{id}', ['as' => 'vendor-package.data', 'uses' => 'Admin\\VendorPackageController@listIndex']);
        Route::get('/create/{vendorId}', ['as' => 'vendor-package.create', 'uses' => 'Admin\\VendorPackageController@create']);
        Route::post('/create/{vendorId}', ['as' => 'vendor-package.store', 'uses' => 'Admin\\VendorPackageController@store']);
        Route::get('/{id}/edit', ['as' => 'vendor-package.edit', 'uses' => 'Admin\\VendorPackageController@edit']);
        Route::patch('/{id}', ['as' => 'vendor-package.update', 'uses' => 'Admin\\VendorPackageController@update']);
        Route::delete('/{id}', ['as' => 'vendor-package.delete', 'uses' => 'Admin\\VendorPackageController@delete']);
    });

    Route::group(['prefix' =>'transaction'], function() {
        Route::get('/data', ['as' => 'transaction.data', 'uses' => 'Admin\\TransactionController@listIndex']);
        Route::get('/{id}', ['as' => 'transaction.show', 'uses' => 'Admin\\TransactionController@show']);
        Route::patch('/{id}', ['as' => 'transaction.update', 'uses' => 'Admin\\TransactionController@update']);
        Route::get('/edit/{id}', ['as' => 'transaction.edit', 'uses' => 'Admin\\TransactionController@edit']);
        Route::get('/', ['as' => 'transaction.index', 'uses' => 'Admin\\TransactionController@index']);
    });

    Route::group(['prefix' =>'transaction-detail'], function() {
        Route::get('/data/{id}', ['as' => 'transaction-detail.data', 'uses' => 'Admin\\TransactionDetailController@listIndex']);
        Route::get('/show/{id}', ['as' => 'transaction-detail.show', 'uses' => 'Admin\\TransactionDetailController@show']);
        Route::get('/edit/{id}', ['as' => 'transaction-detail.edit', 'uses' => 'Admin\\TransactionDetailController@edit']);
        Route::get('/', ['as' => 'transaction-detail.index', 'uses' => 'Admin\\TransactionDetailController@index']);
    });

    Route::group(['prefix' =>'transaction-payment'], function() {
        Route::get('/data/{id}', ['as' => 'transaction-payment.data', 'uses' => 'Admin\\TransactionPaymentController@listIndex']);
        Route::get('/show/{id}', ['as' => 'transaction-payment.show', 'uses' => 'Admin\\TransactionPaymentController@show']);
        Route::get('/', ['as' => 'transaction-payment.index', 'uses' => 'Admin\\TransactionPaymentController@index']);
    });

    Route::group(['prefix' =>'home'], function() {
        Route::get('/transaction-pending', ['as' => 'home.transaction-pending.data', 'uses' => 'Admin\\DashboardController@transactionPending']);
        Route::get('/show/{id}', ['as' => 'transaction-detail.show', 'uses' => 'Admin\\TransactionDetailController@show']);
        Route::get('/edit/{id}', ['as' => 'transaction-detail.edit', 'uses' => 'Admin\\TransactionDetailController@edit']);
        Route::get('/', ['as' => 'transaction-detail.index', 'uses' => 'Admin\\TransactionDetailController@index']);
    });

    Route::group(['prefix' =>'report-problem'], function() {
        Route::get('/data', ['as' => 'report-problem.data', 'uses' => 'Admin\\ReportProblemController@listIndex']);
        Route::get('/', ['as' => 'report-problem.index', 'uses' => 'Admin\\ReportProblemController@index']);
        Route::delete('/{id}', ['as' => 'report-problem.delete', 'uses' => 'Admin\\ReportProblemController@delete']);
    });
    
    Route::get('/message/data', ['as' => 'message.data', 'uses' => 'Admin\\MessageController@listIndex']);
    Route::resource('/message', 'Admin\\MessageController');
    
    Route::get('/bank/data', ['as' => 'bank.data', 'uses' => 'Admin\\BankController@listIndex']);
	Route::resource('/bank', 'Admin\\BankController');
});