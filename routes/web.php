<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;

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
    // return "Hello World!";
});

Route::get('/pzn', function () {
    return "Hello Programmer zaman now";
});

Route::redirect('/youtube', 'pzn');

Route::fallback(function () {
    return "404 By Programmer Zaman Now";
});

Route::view('/hello', 'hello', ['name' => 'Fauzan']);

Route::get('/hello-again', function () {
    return view('hello', ['name' => 'Fauzan']);
});
Route::get('/hello-world', function () {
    return view('hello.world', ['name' => 'Fauzan']);
});


Route::get('/products/{id}', function ($productId) {
    return "Product $productId";
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
    return "Product $productId, Item $itemId";
})->name('product.item.detail');

Route::get('/categories/{id}', function (string $categoryId) {
    return "Category $categoryId";
})->where('id', '[0-9]+')->name('category.detail');


Route::get('/users/{id?}', function ($userId = '404') {
    return "User $userId";
})->name('user.detail');

Route::get('/conflict/fauzan', function () {
    return "Conflict Fauzan Masud Ramadhani";
});

Route::get('/conflict/{name}', function ($name) {
    return "Conflict $name";
});

Route::get('/produk/{id}', function ($id) {
    $link = route('product.detail', ['id' => $id]);
    return "Link $link";
});

Route::get('/produk-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', ['id' => $id]);
});

Route::get('/controller/hello/request', [HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']);
