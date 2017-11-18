<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Score;

use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
	{
		$author = Author::orderBy('updated_at', 'desc')->first();
		$score = Score::orderBy('updated_at', 'desc')->first();

		return response()->view('public.sitemap.index', [
			'author' => $author,
			'score' => $score,
		])->header('Content-Type', 'text/xml');
	}

	public function categories()
	{
		return response()->view('public.sitemap.categories')->header('Content-Type', 'text/xml');
	}

	public function authors()
	{
		$authors = Author::get();
		return response()->view('public.sitemap.authors', [
			'authors' => $authors,
		])->header('Content-Type', 'text/xml');
	}

	public function scores()
	{
		$scores = Score::get();
		return response()->view('public.sitemap.scores', [
			'scores' => $scores,
		])->header('Content-Type', 'text/xml');
	}
}
