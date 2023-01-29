<?php
  
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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

Route::group([], function(){
    Route::prefix('/')->group(function(){
        Route::get('add-fake-books', [BookController::class, 'addFakeBooks']);
	    Route::get('books', [BookController::class, 'bookRequest']);
        Route::post('add-book', [BookController::class, 'addBook']);
        Route::get('is-exist-book-title', [BookController::class, 'isExistBookTitle']);
        Route::get('view-book-detail/{id}', [BookController::class, 'viewBookDetail']);
        Route::get('edit-book/{id}', [BookController::class, 'showEditBookInfo']);
        Route::post('edit-book-info', [BookController::class, 'editBookInfo']);
        Route::get('delete-book', [BookController::class, 'deleteBook']);
	    Route::post('books', [BookController::class, 'searchBooks']);

	});

});