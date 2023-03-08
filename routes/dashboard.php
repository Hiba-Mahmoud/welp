<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 'middleware'=>['role:super_admin']

Route::group(['prefix' => 'admin',], function() {
    Route::post('/importCsv','PlaceDetailsController@importCsv');
    Route::post('/createorupdate','PlaceDetailsController@createOrupdate');
    //users
    Route::get('/users','AdminController@listUsers');
    Route::get('/trashed-users','AdminController@listBannedUsers');
    Route::get('/banned-user','AdminController@bannedUser');
    Route::get('/restore-user','AdminController@restoreUser');
    //comments
    Route::get('/comments','AdminController@listComments');



});
