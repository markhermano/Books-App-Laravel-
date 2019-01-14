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
    return redirect('/login');
});

Auth::routes();

Route::get('dashboard', 'DashboardController@index');
Route::get('administration', 'UsersController@index')->middleware('role:admin');
Route::get('booksAdministration', 'BooksController@index')->middleware('role:writer');
Route::get('booksAdministration/editReaderIndex/{bookID}', 'BooksController@addReaderIndex')->middleware('role:writer');
Route::post('addReader', 'BooksController@addReaders')->middleware('role:writer');
Route::delete('removeReader', 'BooksController@removeReaders')->middleware('role:writer');
Route::resource('users', 'UsersController');
Route::resource('books', 'BooksController');
// Route::resource('readers', 'BookReadersController');
// Route::get('readers/{bookid}', 'BooksController@getReaders')->middleware('role:writer');
