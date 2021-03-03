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
    return redirect('home');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('verifyAccessToken');

Route::post('/qbo_auth', 'QBOAuthController@store');
