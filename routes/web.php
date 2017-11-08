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
		
		Route::get('/authors/add', 'AuthorController@showAdd')->name('admin_authors_add');
		Route::post('/authors/add', 'AuthorController@add')->name('admin_authors_add_store');

		Route::get('/authors/edit/{id_author}', 'AuthorController@showEdit')->name('admin_authors_edit');
		Route::post('/authors/edit', 'AuthorController@edit')->name('admin_authors_edit_store');

		Route::get('/authors/remove/{id_author}', 'AuthorController@remove')->name('admin_authors_remove');

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

Route::get('/telecharger/{slug}', 'ScoreController@download')->name('score_download');
Route::get('/partitions/{slug_author}/{slug_score}', 'ScoreController@show')->name('score');
Route::get('/partitions', 'ScoreController@showAll')->name('scores');

//AUTHOR CONTROLLER
Route::get('/partitions/{slug_author}', 'AuthorController@showScores')->name('author_scores');
