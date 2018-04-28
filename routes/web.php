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
			Route::get('/{id_author}-{difficulty}-{is_online}', 'ScoreController@showFiltered')->name('admin_scores_filtered');

			Route::get('/add', 'ScoreController@showAdd')->name('admin_scores_add');
			Route::post('/add', 'ScoreController@add')->name('admin_scores_add_store');

			Route::get('/edit/{id_score}', 'ScoreController@showEdit')->name('admin_scores_edit');
			Route::post('/edit', 'ScoreController@edit')->name('admin_scores_edit_store');

			Route::get('/remove/{id_score}', 'ScoreController@remove')->name('admin_scores_remove');
		});

		Route::group( ['prefix' => 'glossaries' ], function()
		{
			Route::get('/{slug_glossary?}', 'GlossaryController@show')->name('admin_glossaries');
			Route::post('/add', 'GlossaryController@add')->name('admin_glossaries_add_store');
			Route::post('/edit', 'GlossaryController@edit')->name('admin_glossaries_edit_store');
			Route::get('/remove/{id_glossary}', 'GlossaryController@remove')->name('admin_glossaries_remove');
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

// AJAX
Route::post('ajax/score/comment', 'AjaxController@storeComment')->name('ajax_comment');
Route::post('ajax/score/rating', 'AjaxController@storeRating')->name('ajax_rating');

/** COMMON ROUTES **/
Route::post('/contact', 'HomeController@contactusSave')->name('contact_us_submit');
Route::get('/contact', 'HomeController@contactusShow')->name('contact_us');
/** COMMON ROUTES **/

Route::group(array('domain' => 'pianolovescore.' . (env('APP_ENV') == 'production'?'com':'dev')), function(){		/** ROUTES : FR */
	Route::get('/', 'HomeController@show')->name('accueil');

	Route::get('/rechercher', 'HomeController@searchByForm')->name('recherche');
	Route::get('/rechercher/{q}', 'HomeController@search')->name('recherche_par_formulaire');

	// SCORE CONTROLLER
	Route::post('/demander-une-partition', 'ScoreController@requestSave')->name('demande_partition_envoi');
	Route::get('/demander-une-partition', 'ScoreController@requestShow')->name('demande_partition');

	Route::get('/telecharger/{slug}', 'ScoreController@download')->name('partition_telechargement');
	Route::get('/partitions/{slug_author}/{slug_score}', 'ScoreController@show')->name('partition');
	Route::get('/partitions', 'ScoreController@showAll')->name('partitions');
	Route::get('/partitions/{difficulty}', 'ScoreController@showLevel')->name('partitions_difficulte')
	->where(['difficulty' => 'tres-faciles|faciles|intermediaires|difficiles|tres-difficiles']);

	//AUTHOR CONTROLLER
	Route::get('/partitions/{slug_author}', 'AuthorController@showScores')->name('auteur_partitions');

	//LEXIQUE CONTROLLER
	Route::get('/lexique/{letter?}', 'GlossaryController@show')->name('lexique');

	//TRICK CONTROLLER
	Route::get('/astuces/{slug}', 'TrickController@show')->name('astuce');
	Route::get('/astuces', 'TrickController@showAll')->name('astuces');

	Route::group( ['prefix' => 'sitemap' ], function()
	{
		Route::get('/', 'SitemapController@index')->name('sitemap');
		Route::get('categories', 'SitemapController@categories')->name('sitemap_categories');
		Route::get('auteurs', 'SitemapController@authors')->name('sitemap_auteurs');
		Route::get('partitions', 'SitemapController@scores')->name('sitemap_partitions');
		Route::get('lexiques', 'SitemapController@glossaries')->name('sitemap_lexiques');
		Route::get('astuces', 'SitemapController@tricks')->name('sitemap_astuces');
		Route::get('difficultes', 'SitemapController@difficulties')->name('sitemap_difficultes');
	});
});

Route::group(array('domain' => 'en.pianolovescore.' . (env('APP_ENV') == 'production'?'com':'dev')), function() {
	/** ROUTES : EN */
	Route::get('/', 'HomeController@show')->name('home');

	Route::get('/search', 'HomeController@searchByForm')->name('search');
	Route::get('/search/{q}', 'HomeController@search')->name('search_by_form');

	// SCORE CONTROLLER
	Route::post('/request-a-score', 'ScoreController@requestSave')->name('score_request_submit');
	Route::get('/request-a-score', 'ScoreController@requestShow')->name('score_request');

	Route::get('/download/{slug}', 'ScoreController@download')->name('score_download');
	Route::get('/scores/{slug_author}/{slug_score}', 'ScoreController@show')->name('score');
	Route::get('/scores', 'ScoreController@showAll')->name('scores');
	Route::get('/scores/{difficulty}', 'ScoreController@showLevel')->name('scores_difficulty')
	->where(['difficulty' => 'very-easy|easy|intermediate|hard|very-hard']);

	//AUTHOR CONTROLLER
	Route::get('/scores/{slug_author}', 'AuthorController@showScores')->name('author_scores');

	//LEXIQUE CONTROLLER
	Route::get('/glossary/{letter?}', 'GlossaryController@show')->name('glossary');

	//TRICK CONTROLLER
	Route::get('/tricks/{slug}', 'TrickController@show')->name('trick');
	Route::get('/tricks', 'TrickController@showAll')->name('tricks');
	
	Route::group( ['prefix' => 'sitemap' ], function()
	{
		Route::get('/', 'SitemapController@index')->name('sitemap');
		Route::get('categories', 'SitemapController@categories')->name('sitemap_categories');
		Route::get('authors', 'SitemapController@authors')->name('sitemap_authors');
		Route::get('scores', 'SitemapController@scores')->name('sitemap_scores');
		Route::get('glossaries', 'SitemapController@glossaries')->name('sitemap_glossaries');
		Route::get('tricks', 'SitemapController@tricks')->name('sitemap_tricks');
		Route::get('difficulties', 'SitemapController@difficulties')->name('sitemap_difficulties');
	});
});