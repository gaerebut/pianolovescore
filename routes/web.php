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

//ADMIN
//
// CRSF ACTIVATED
//
Route::group( ['namespace' => 'Admin', 'prefix' => 'admin' ], function()
{
	Route::get('login', 'HomeController@login')->name('admin_login');
	Route::post('login', 'HomeController@connect')->name('admin_login_connect');
	Route::get('logout', 'HomeController@disconnect')->name('admin_logout');

	Route::group( [ 'middleware' => 'guest' ], function()
	{
		Route::get('/', 'HomeController@show')->name('admin_home');
		
		Route::get('/authors', 'AuthorController@show')->name('admin_authors');
		Route::get('/authors/ajouter', 'AuthorController@showAdd')->name('admin_authors_add');
		Route::post('/authors/ajouter', 'AuthorController@add')->name('admin_authors_add_store');

		Route::get('/scores', 'ScoreController@show')->name('admin_scores');
		Route::get('/tips', 'TipsController@show')->name('admin_tips');
		Route::get('/scores-requests', 'ScoreController@scoreRequest')->name('admin_scores_requests');
	} );
} );

Route::post('ajax/score/rating', 'AjaxController@storeRating')->name('ajax_rating');

// HOME CONTROLLER
Route::get('/', 'HomeController@show')->name('home');

// SCORE CONTROLLER
Route::post('/demander-une-partition', 'ScoreController@requestSave')->name('score_request_submit');
Route::get('/demander-une-partition', 'ScoreController@requestShow')->name('score_request');

Route::get('/download/{slug}', 'ScoreController@download')->name('score_download');
Route::get('/partitions/{composer_slug}/{score_slug}', 'ScoreController@show')->name('score');
Route::get('/partitions', 'ScoreController@showAll')->name('scores');

//AUTHOR CONTROLLER
Route::get('/partitions/{composer_slug}', 'AuthorController@showScores')->name('author_scores');
