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
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/createProject','CreateProjectController@index' );
Route::get('/allPdf','AllPdfController@index' );
Route::get('/data','DataController@index' );
Route::get('/pictures','PicturesController@index' );
Route::get('/homePage','HomePageController@index' );
Route::post('/operating', 'CreateProjectController@operating_pdf')->name('operating');
Route::post('/pdfGenerate', 'CreateProjectController@pdfGenerate')->name('pdfGenerate');
Route::post('/pdfInformArray', 'AllPdfController@pdfInformArray')->name('pdfInformArray');

Route::post('/xlsxuploadingToJson', 'DataController@xlsxuploadingToJson')->name('xlsxuploadingToJson');
