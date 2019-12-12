<?php
/*header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With, Application, api_key');*/

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

Route::group(['middleware' => ['cors']], function () {
    Route::prefix('v1')->namespace('Api')->group(function () {
        //public routes
        Route::post('requestToken', 'Auth\\LoginJwtController@login')->name('requestToken');
        Route::post('registerUser', 'Auth\\LoginJwtController@register')->name('registerUser');

        //FIM PUBLIC ROUTES

        //middleware jwt
        Route::group(['middleware' => ['jwt.auth']], function () {
            //ROUTES USERS
            Route::prefix('users')->group(function () {
                Route::get('list', 'Users\\UserController@index')->name('list');
                Route::get('listdeleted', 'Users\\UserController@listUserDeleted')->name('listdeleted');
                Route::post('list/{id}', 'Users\\UserController@show')->name('listuser');
                Route::delete('delete/{id}', 'Users\\UserController@destroy')->name('delete');
                Route::put('update/{id}', 'Users\\UserController@update')->name('update');
            });
            // FIM ROUTES USERS

            //ROUTES LOGS
            Route::prefix('/logs')->group(function() {
                Route::get('/list', 'Logs\\LogController@index')->name('logs');
                Route::get('/list/{id}', 'Logs\\LogController@show')->name('single_logs');
                Route::post('/create', 'Logs\\LogController@create')->name('create_logs');
                Route::post('/tofile/{id}', 'Logs\\LogController@toFile')->name('tofile');
                Route::get('/filled', 'Logs\\LogController@filled')->name('filled');
                Route::get('/search', 'Logs\\LogController@search')->name('search');
                Route::delete('delete/{id}', 'Logs\\LogController@destroy')->name('delete');

            });

            Route::prefix('/exclusions')->group(function() {
                Route::post('/create', 'Exclusions\\ExclusionsController@create')->name('delete_logs');
                Route::get('/list', 'Exclusions\\ExclusionsController@index')->name('list_exclusions');
                Route::get('/list/{id}', 'Exclusions\\ExclusionsController@show')->name('single_exclusions');
            });

            //FIM ROUTES LOGS
        });
        //FIM MIDDLEWARE JWT
    });
});



/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
