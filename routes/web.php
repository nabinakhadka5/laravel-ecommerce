<?php

use Illuminate\Support\Facades\Route;

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


/***** Home Page *****/
Route::get('/page/{slug}','PageController@PageDetail')->name('page-detail');
Route::get('/products','ProductController@getAllProducts')->name('products-list');
Route::get('/products/featured','ProductController@getAllFeaturedProducts')->name('featured-product');
Route::get('/category/{slug}','CategoryController@getAllProductByCat')->name('cat-detail');
Route::get('/category/{parent_slug}/{slug}','CategoryController@getAllProductBySubCat')->name('sub_cat_detail');


Route::get('/search','ProductController@getSearchResult')->name('search');

Route::get('/contact-us','FrontendController@getContactUsPage')->name('contact-us');
Route::get('/','FrontendController@homePage')->name('homepage');

/****** End Home page ****/

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix'=>'admin','middleware'=>['auth','admin']],function(){
    Route::get('/','HomeController@admin')->name('admin');
    Route::resource('slider','SliderController')->except('show');
    Route::post('get-child','CategoryController@getAllChild')->name('get-child');
    Route::resource('category','CategoryController');
    Route::resource('product','ProductController');
    Route::resource('page','PageController');
});

Route::group(['prefix'=>'customer','middleware'=>['auth','customer']],function(){
    Route::get('/','HomeController@customer')->name('customer');

});

Route::group(['prefix'=>'seller','middleware'=>['auth','seller']],function(){
    Route::get('/','HomeController@seller')->name('seller');

});

