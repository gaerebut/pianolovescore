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

		Route::group( ['prefix' => 'comments' ], function()
		{
			Route::get('/', 'CommentController@show')->name('admin_comments');

			Route::get('/online/{id_comment}', 'CommentController@setOnline')->name('admin_comments_online');
			Route::get('/offline/{id_comment}', 'CommentController@setOffline')->name('admin_comments_offline');

			Route::get('/remove/{id_comment}', 'CommentController@remove')->name('admin_comments_remove');
		});

		Route::group( ['prefix' => 'tricks' ], function()
		{
			Route::get('/', 'TrickController@show')->name('admin_tricks');

			Route::get('/add', 'TrickController@showAdd')->name('admin_tricks_add');
			Route::post('/add', 'TrickController@add')->name('admin_tricks_add_store');

			Route::get('/edit/{id_trick}', 'TrickController@showEdit')->name('admin_tricks_edit');
			Route::post('/edit', 'TrickController@edit')->name('admin_tricks_edit_store');

			Route::get('/remove/{id_trick}', 'TrickController@remove')->name('admin_tricks_remove');
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

Route::group( ['prefix' => 'sitemap' ], function()
{
	Route::get('/', 'SitemapController@index')->name('sitemap');
	Route::get('categories', 'SitemapController@categories')->name('sitemap_categories');
	Route::get('authors', 'SitemapController@authors')->name('sitemap_authors');
	Route::get('scores', 'SitemapController@scores')->name('sitemap_scores');
	Route::get('tricks', 'SitemapController@tricks')->name('sitemap_tricks');
	Route::get('difficulties', 'SitemapController@difficulties')->name('sitemap_difficulties');
});

// AJAX
Route::post('ajax/score/comment', 'AjaxController@storeComment')->name('ajax_comment');
Route::post('ajax/score/rating', 'AjaxController@storeRating')->name('ajax_rating');

// HOME CONTROLLER
Route::get('/', 'HomeController@show')->name('home');

Route::post('/contact', 'HomeController@contactusSave')->name('contactus_submit');
Route::get('/contact', 'HomeController@contactusShow')->name('contactus');

Route::get('/rechercher', 'HomeController@search')->name('search');
Route::get('/rechercher/{q}', 'HomeController@search')->name('search');

// SCORE CONTROLLER
Route::post('/demander-une-partition', 'ScoreController@requestSave')->name('score_request_submit');
Route::get('/demander-une-partition', 'ScoreController@requestShow')->name('score_request');

Route::get('/telecharger/{slug}', 'ScoreController@download')->name('score_download');
Route::get('/partitions/{slug_author}/{slug_score}', 'ScoreController@show')->name('score');
Route::get('/partitions', 'ScoreController@showAll')->name('scores');
Route::get('/partitions/{difficulty}', 'ScoreController@showLevel')->name('scores_difficulty')
->where(['difficulty' => 'tres-faciles|faciles|intermediaires|difficiles|tres-difficiles']);

//AUTHOR CONTROLLER
Route::get('/partitions/{slug_author}', 'AuthorController@showScores')->name('author_scores');

//TRICK CONTROLLER
Route::get('/astuces/{slug}', 'TrickController@show')->name('trick');
Route::get('/astuces', 'TrickController@showAll')->name('tricks');