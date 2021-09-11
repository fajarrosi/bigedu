<?php

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

Route::post('/login','Auth\LoginController@login');
Route::post('/register','Auth\RegisterController@register');
Route::post('/isemailexist','Auth\RegisterController@isemailexist');


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// get list webinar untuk front end untuk user liat dan admin jika ingin mengedit webinar
Route::get('/webinar','Webinar\WebinarController@index');

// get webinar detail untuk user liat tgl dan jam webinar, admin dapat mengedit dari isi webinar
Route::get('/webinar/{webinar}','Webinar\WebinarController@show');

// untuk peserta dapat mendaftarkan webinar ataupun si admin dapat juga akses jika diperlukan untuk mendaftarkan secara manual
Route::post('/peserta_webinar','PesertaController@store');

// Route::resource('/peserta_webinar','PesertaController')->except(['edit','create']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout','Auth\LoginController@logout');
    // Endpoint yang hanya untuk admin
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('/user','UserController')->except(['edit','create']);
        Route::resource('/pembicara','Webinar\PembicaraController')->except(['edit','create']);
        Route::resource('/webinar','Webinar\WebinarController')->except(['edit','create','index','show']);
    });
});