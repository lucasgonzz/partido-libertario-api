<?php

use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


    // CommonLaravel 
    // ----------------------------------------------------------------------------------------------------
    // Generals
    Route::post('search/{model_name}', 'CommonLaravel\SearchController@search');
    Route::post('search-from-modal/{model_name}', 'CommonLaravel\SearchController@searchFromModal');
    Route::post('search/save-if-not-exist/{model_name}/{propertye}/{query}', 'CommonLaravel\SearchController@saveIfNotExist');
    Route::get('previus-day/{model_name}/{index}', 'CommonLaravel\PreviusDayController@previusDays');
    Route::get('previus-next/{model_name}/{index}', 'CommonLaravel\PreviusNextController@previusNext');
    Route::get('previus-next-index/{model_name}/{id}', 'CommonLaravel\PreviusNextController@getIndexPreviusNext');
    Route::put('update/{model_name}', 'CommonLaravel\UpdateController@update');
    Route::put('delete/{model_name}', 'CommonLaravel\DeleteController@delete');
    
    // User
    Route::get('user', 'CommonLaravel\AuthController@user');
    Route::put('user/{id}', 'UserController@update');
    Route::put('user-password', 'CommonLaravel\UserController@updatePassword');
    Route::post('user/last-activity', 'CommonLaravel\UserController@setLastActivity');

    // Employee
    Route::resource('employee', 'CommonLaravel\EmployeeController');

    // Permissions
    Route::get('permission', 'CommonLaravel\PermissionController@index');

    // Images
    Route::post('set-image/{prop}', 'CommonLaravel\ImageController@setImage');
    Route::delete('delete-image-prop/{model_name}/{id}/{prop_name}', 'CommonLaravel\ImageController@deleteImageProp');
    Route::delete('delete-image-model/{model_name}/{model_id}/{image_id}', 'CommonLaravel\ImageController@deleteImageModel');
    Route::post('upload-image', 'CommonLaravel\ImageController@uploadImage');

    // Error
    Route::post('error', 'CommonLaravel\ErrorController@store');

    // ----------------------------------------------------------------------------------------------------

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('user', function() {
    if (Auth::check()) {
        return response()->json(['user' => Auth::user()], 200);
    } 
    return response(null, 401);
});

// Admin
Route::resource('affiliate', 'AffiliateController');

// Departament
Route::resource('departament', 'DepartamentController');

// Blogs
Route::resource('blog', 'BlogController');

Route::put('user/password', [AuthController::class, 'updatePassword']);

// Donations
Route::get('donations', 'DonationController@index');
Route::post('donations', 'DonationController@store');

// Referents
Route::resource('referent', 'ReferentController');
// Route::put('referents/image/{id}', 'ReferentController@updateImage');


