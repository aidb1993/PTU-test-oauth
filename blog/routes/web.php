<?php

use App\User;
use Illuminate\Support\Facades\Auth;
use QuickBooksOnline\API\DataService\DataService;
use QuickBooksOnline\API\Core\OAuth\OAuth2\OAuth2LoginHelper;

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

/* Route::get('/', 'QuickBookController@store');*/

Route::get('create/new/token', 'QuickBookController@index')->middleware('auth');

Route::get('refresh/new/token', 'QuickBookController@refreshToken');

Route::get('/', function() {
    return view('/auth/login');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/qbo_auth', 'QBOAuthController@store');

//Route::get('/', function () {

    // $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
    // $accessTokenValue = $OAuth2LoginHelper->getAccessToken();
    // dd($accessTokenValue);
    // $refreshedAccessTokenObj = $OAuth2LoginHelper->refreshToken();
    // $error = $OAuth2LoginHelper->getLastError();
    // if($error){
    //     return $error;
    // }else{
    //     //Refresh Token is called successfully
    //    $refresh = $dataService->updateOAuth2Token($refreshedAccessTokenObj);

    // }

    // $dataService->FindById("Invoice", 1);

//});
