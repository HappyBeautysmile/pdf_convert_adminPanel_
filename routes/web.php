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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'HomeController@firstPage');

Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/creer-un-projet','CreateProjectController@index' );
Route::get('/visualiser-les-pdf','AllPdfController@index' );
Route::get('/folders','FoldersController@index' );
Route::post('/addFolder','FoldersController@addFolder')->name('addFolder');
Route::post('/renameFolder','FoldersController@renameFolder')->name('renameFolder');
Route::post('/deleteFolder','FoldersController@deleteFolder')->name('deleteFolder');

Route::post('/getFolderDirInform','FoldersController@getFolderDirInform')->name('getFolderDirInform');

// getFolderDirInform

Route::get('/data','DataController@index' );
Route::get('/portfolio','PicturesController@index' );

Route::post('/imageFilesInform', 'PicturesController@imageFilesInform')->name('imageFilesInform');

Route::get('/dashboard','HomePageController@index' );
Route::post('/operating', 'CreateProjectController@operating_pdf')->name('operating');
Route::post('/pdfGenerate', 'CreateProjectController@pdfGenerate')->name('pdfGenerate');
Route::post('/pdfInformArray', 'AllPdfController@pdfInformArray')->name('pdfInformArray');

Route::post('/xlsxuploadingToJson', 'DataController@xlsxuploadingToJson')->name('xlsxuploadingToJson');
