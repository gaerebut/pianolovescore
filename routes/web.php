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

Route::get('download/{slug}', 'ScoreController@download')->name('score.download');
Route::get('partitions', 'ScoreController@showAll')->name('scores.showAll');
Route::get('partitions/{composer_slug}', 'ScoreController@showForAComposer')->name('scores.showForAComposer');
Route::get('partitions/{composer_slug}/{score_slug}', 'ScoreController@show')->name('scores.show');