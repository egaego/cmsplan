<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/**
 * with validation Content Type: application/json
 */
//Route::get('trigger', function() {
//    $userRelations = App\UserRelation::get();
//    foreach ($userRelations as $userRelation) {
//        $userRelation->femaleUser->insertFirstContentData();
//    }
//});
Route::get('test', function() {
$trx = \App\Transaction::find(1);
$trx->sendPaymenInvoiceNotification();
});
Route::group(['prefix' => 'v1'], function () {
    
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/register', 'Api\AuthController@register');
        Route::post('/register-invitation', 'Api\AuthController@registerInvitation');
        Route::post('/login', 'Api\AuthController@login');
        Route::post('/forgot-password', 'Api\AuthController@forgotPassword');
        Route::post('/reset-password', 'Api\AuthController@resetPassword');
        
        Route::group(['middleware' => ['jwt.auth']], function () {
            Route::post('/logout', 'Api\AuthController@logout');
        });
    });
    
    Route::get('/procedure', 'Api\RequestController@procedure');
    Route::get('/page/{category}', 'Api\RequestController@getPage');
    
    Route::group(['prefix' => 'vendor'], function () {
        Route::get('/concept', 'Api\VendorController@concept');
        Route::get('/detail/{conceptId}', 'Api\VendorController@list');
    });

    Route::group(['prefix' => 'gallery'], function () {
        Route::get('/', 'Api\GalleryController@index');
        Route::get('/categories', 'Api\GalleryController@galleryConcepts');
    });
    
    Route::group(['middleware' => ['jwt.auth']], function () {

        Route::get('/list-bank', 'Api\RequestController@listBank');

        Route::group(['prefix' => 'transaction'], function () {
            Route::post('/store', 'Api\RequestController@setupTransaction');
            Route::get('/histories', 'Api\RequestController@transactionHistory');
            Route::post('/rating', 'Api\RequestController@submitRating');
        });

        Route::group(['prefix' => 'contents'], function () {
            Route::get('/{conceptId}/{isCustomConcept}', 'Api\ContentController@index');
            Route::post('/store/{conceptId}/{isCustomConcept}', 'Api\ContentController@store');
            Route::patch('/update/{id}', 'Api\ContentController@update');
            Route::delete('/delete/{id}', 'Api\ContentController@delete');
        });

        Route::group(['prefix' => 'gallery'], function () {
            Route::get('/user-galleries', 'Api\GalleryController@userGalleries');
            Route::post('/store/{galleryId}', 'Api\GalleryController@store');
            Route::delete('/delete/{galleryId}', 'Api\GalleryController@delete');
        });

        Route::group(['prefix' => 'vendor'], function () {
            Route::get('/user-vendor', 'Api\VendorController@userVendors');
            Route::post('/store/{conceptId}', 'Api\VendorController@store');
            Route::delete('/delete/{conceptId}', 'Api\VendorController@delete');
        });
                       
        Route::group(['prefix' => 'concepts'], function () {
            Route::get('/', 'Api\ConceptController@index');
            Route::get('/list-concepts', 'Api\ConceptController@listConcepts');
            Route::post('/store', 'Api\ConceptController@store');
            Route::patch('/update/{id}', 'Api\ConceptController@update');
            Route::delete('/delete/{id}', 'Api\ConceptController@delete');
        });
        
        Route::get('/costs', 'Api\UserController@costs');
        Route::get('/messages', 'Api\RequestController@listMessages');
        
        Route::group(['prefix' => 'procedure-administrations'], function () {
            Route::get('/', 'Api\ProcedureAdministrationController@index');
            Route::post('/', 'Api\ProcedureAdministrationController@store');
        });
        
        Route::group(['prefix' => 'procedure-payment'], function () {
            Route::get('/', 'Api\ProcedurePaymentController@index');
            Route::post('/', 'Api\ProcedurePaymentController@store');
            Route::patch('/{id}', 'Api\ProcedurePaymentController@update');
            Route::delete('/{id}', 'Api\ProcedurePaymentController@delete');
        });
        
        Route::group(['prefix' => 'procedure-preparation'], function () {
            Route::get('/', 'Api\ProcedurePreparationController@index');
            Route::post('/', 'Api\ProcedurePreparationController@store');
            Route::patch('/{id}', 'Api\ProcedurePreparationController@update');
            Route::delete('/{id}', 'Api\ProcedurePreparationController@delete');
        });
                
        Route::group(['prefix' => 'content-details'], function () {
            Route::get('/{contentId}', 'Api\ContentDetailController@index');
            Route::post('/store/{contentId}', 'Api\ContentDetailController@store');
            Route::patch('/update/{id}', 'Api\ContentDetailController@update');
            Route::delete('/delete/{id}', 'Api\ContentDetailController@delete');
        });
        
        Route::group(['prefix' => 'content-detail-lists'], function () {
            Route::get('/{contentDetailId}', 'Api\ContentDetailListController@index');
            Route::post('/store/{contentDetailId}', 'Api\ContentDetailListController@store');
            Route::delete('/delete/{id}', 'Api\ContentDetailListController@delete');
        });
        
        Route::post('report-problem', 'Api\RequestController@storeReportProblem');
        
        Route::group(['prefix' => 'user'], function () {
            Route::get('/show/{code}', 'Api\UserController@show');
            Route::patch('/update/{code}', 'Api\UserController@update');
            Route::post('/upload-photo-profile/{code}', 'Api\UserController@updatePhotoProfile');
            Route::post('/upload-photo/{code}', 'Api\UserController@updatePhoto');
            Route::post('/change-password', 'Api\UserController@changePassword');
            Route::delete('/delete-photo/{code}', 'Api\UserController@deletePhoto');
            Route::delete('/delete-photo-profile/{code}', 'Api\UserController@deletePhotoProfile');
            Route::patch('/re-send-relation/{id}', 'Api\UserController@resendRegisterRelation');
            Route::patch('/update/relation/{code}', 'Api\UserController@updateRelation');
        });

        Route::group(['prefix' => 'concept-detail'], function () {
            Route::get('/', 'Api\ConceptDetailController@index');
            Route::post('/store', 'Api\ConceptDetailController@store');
            Route::delete('/delete/{id}', 'Api\ConceptDetailController@delete');
        });
    });
    
});

/**
 * without validation Content Type: application/json
 */
Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/register-counselor-upload-files', 'Api\AuthController@registerCounselorUploadFiles');
    });
    
    Route::group(['prefix' => 'payment'], function () {
        Route::get('info-code', 'Api\Midtrans\PaymentController@infoCode');
        Route::post('/checkout', 'Api\Midtrans\PaymentController@checkout');
        
        Route::post('/notification', 'Api\Midtrans\PaymentController@notification');
    });
});
