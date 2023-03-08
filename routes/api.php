<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::middleware('Server')->group(function(){
    // Auth
    Route::prefix('Auth')->group(function(){
        Route::post('Login','AuthController@Login');
        Route::post('Profile','AuthController@Profile');

        // send verification
        Route::post('verifyEmail','AuthController@verifyEmail');
        // ////////////////////
        Route::post('updateOrCreate','AuthController@updateOrCreate');
    });

    Route::prefix('Category')->group(function(){

        Route::get('/','CategoryController@index');

        Route::get('/withPagination','CategoryController@withPagination');

        Route::post('/getPlacesFromCategory','CategoryController@getPlacesFromCategory');

        Route::post('/updateOrCreate','CategoryController@updateOrCreate');


        Route::get('/{id}','CategoryController@Scope');

    });

    Route::prefix('Place')->group(function(){
        Route::get('/import','PlaceController@import');

        Route::get('/','PlaceController@index');

        Route::get('/withPagination','PlaceController@withPagination');

        Route::post('/updateOrCreate','PlaceController@updateOrCreate');
    // get places for client
        Route::get('/places','PlaceController@places');
        //places belongs to a category
        Route::get('/places-cat','PlaceController@placesBelongsToCategory');

        // form to import csv file
        Route::post('/importCsv','Dashboard\PlaceDetailsController@importCsv');
        // -------------------


        Route::get('/{id}','PlaceController@Scope');

    });

    Route::prefix('Favorite')->group(function(){

        Route::get('get/{user_id}','FavoriteController@get');

        Route::post('create','FavoriteController@create');

        Route::post('delete','FavoriteController@delete');

    });


    Route::prefix('Rating')->group(function(){

        Route::get('/','RatingController@index');

        Route::post('create','RatingController@create');

    });


    Route::prefix('Review')->group(function(){

        Route::get('/','Dashboard\AdminController@Review');

        Route::post('create','ClientSide\ClientController@createComment');

    });

    Route::prefix('Search')->group(function(){

        Route::get('SearchByGet/{Query?}','SearchController@QueryGet');
        Route::post('SearchByPost','SearchController@QueryPost');

        Route::post('getPlacesByNearMe','SearchController@getPlacesByNearMe');

    });
});
