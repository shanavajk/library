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
Route::get('/', 'BooksController@index')->name('books');
Route::post('/books/create', 'BooksController@create');
Route::get('/person', 'PersonController@index');
Route::post('/person/create', 'PersonController@create');

Route::get('/books-issue', 'BooksController@issueBook');
Route::post('/books-issue/store', 'BooksController@storeBookIssued');
Route::any('/books-issue/get', 'BooksController@getAllBookIssued');
Route::post('/books-returned/store', 'BooksController@returnBook');
Route::any('/books-returned/get', 'BooksController@getBooksReturned');

Route::get('/common-prefix', 'PrefixController@index');

Route::get('/diameter-BTree', 'DiameterOfBinaryTree@index');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

