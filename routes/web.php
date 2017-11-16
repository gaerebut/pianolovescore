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
		
		Route::group( ['prefix' => 'authors' ], function()
		{
			Route::get('/', 'AuthorController@show')->name('admin_authors');

			Route::get('/add', 'AuthorController@showAdd')->name('admin_authors_add');
			Route::post('/add', 'AuthorController@add')->name('admin_authors_add_store');

			Route::get('/edit/{id_author}', 'AuthorController@showEdit')->name('admin_authors_edit');
			Route::post('/edit', 'AuthorController@edit')->name('admin_authors_edit_store');

			Route::get('/remove/{id_author}', 'AuthorController@remove')->name('admin_authors_remove');
		});

		Route::group( ['prefix' => 'scores' ], function()
		{
			Route::get('/', 'ScoreController@show')->name('admin_scores');

			Route::get('/add', 'ScoreController@showAdd')->name('admin_scores_add');
			Route::post('/add', 'ScoreController@add')->name('admin_scores_add_store');

			Route::get('/edit/{id_score}', 'ScoreController@showEdit')->name('admin_scores_edit');
			Route::post('/edit', 'ScoreController@edit')->name('admin_scores_edit_store');

			Route::get('/remove/{id_score}', 'ScoreController@remove')->name('admin_scores_remove');
		});

		Route::group( ['prefix' => 'tips' ], function()
		{
			Route::get('/', 'TipController@show')->name('admin_tips');

			Route::get('/add', 'TipController@showAdd')->name('admin_tips_add');
			Route::post('/add', 'TipController@add')->name('admin_tips_add_store');

			Route::get('/edit/{id_tip}', 'TipController@showEdit')->name('admin_tips_edit');
			Route::post('/edit', 'TipController@edit')->name('admin_tips_edit_store');

			Route::get('/remove/{id_tip}', 'TipController@remove')->name('admin_tips_remove');
		});

		Route::group( ['prefix' => 'scores-requests' ], function()
		{
			Route::get('/', 'ScoreRequestController@show')->name('admin_scoresrequests');

			Route::get('/edit/{id_scorerequest}', 'ScoreRequestController@showEdit')->name('admin_scoresrequests_edit');
			Route::post('/edit', 'ScoreRequestController@edit')->name('admin_scoresrequests_edit_store');

			Route::get('/remove/{id_scorerequest}', 'ScoreRequestController@remove')->name('admin_scoresrequests_remove');
		});
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