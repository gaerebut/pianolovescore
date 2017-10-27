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
    return view('public/home');
})->name('home');

// Route::get('/partitions/chopin/etude_n_2_op_34', function () {
//     return view('public/score');
// });

Route::post('ajax/score/rating', 'AjaxController@storeRating')->name('ajax.rating');

Route::get('partitions', 'ScoreController@showByComposers')->name('scores.showByComposer');
Route::get('partitions/{composer}', 'ScoreController@showForComposer')->name('scores.showForComposer');
Route::get('partitions/{composer}/{slug}', 'ScoreController@show')->name('scores.show');