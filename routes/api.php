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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//************* Products routs ********************

//List products
Route::get('products', 'ProductsController@index');

//List single product
Route::get('product/{id}', 'ProductsController@show');

//Create new product
Route::post('product', 'ProductsController@store');

//Update product
Route::put('product/{id}', 'ProductsController@udpdate');


//Delete product
Route::delete('product/{id}', 'ProductsController@destroy');

// Upload the image route
Route::post('upload', 'ProductsController@upload');

//************************************************************



//********* Category routes************************************

// list categories
Route::get('categories', 'CategoryController@index');

// create new category
Route::post('category','CategoryController@store');

// Delete a category
Route::delete('category/{id}', 'CategoryController@destroy');

//*************************************************************


//********************** Subcategories Routes **************************

Route::get('subcategory/{id}', 'CategoryController@fetchsubs');

Route::delete('subcategory/{id}', 'CategoryController@deletesubs');

//***********************************************************************



//************** Route for getting categories for products ****
Route::get('allcategories', 'CategoryController@fetchforproducts');