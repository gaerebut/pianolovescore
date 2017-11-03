<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Rating;
use App\Models\Author;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param string  $composer_slug
    *  @param string $score_slug 
     * @return View
     */
    public function show($composer_slug, $score_slug)
    {
        $score = Score::where('slug', '=', $score_slug)->firstOrFail();
        $rate = Rating::where([
            ['score_id', '=', $score->id],
            ['ip_address', '=', \Request::ip()]
        ])->count();

        return view('public.score', [
            'breadcrumb_last_level' => $score,
            'score'                 => $score,
            'user_already_vote'     => (bool)$rate
        ]);
    }

    public function showAll()
    {
        $authors = Author::orderBy('lastname')->get();

        return view('public.all_scores', [
            'breadcrumb_last_level' => 'Toutes les partitions gratuites de piano',
            'authors'               => $authors
        ]);
    }

    public function showForAComposer($composer_slug)
    {
        $author = Author::where('slug', '=', $composer_slug)->firstOrFail();
        return view('public.author', [
            'breadcrumb_last_level' => $author->fullname,
            'author' => $author
        ]);
    }

    public function download($score_slug)
    {
        $score = Score::where('slug', '=', $score_slug)->firstOrFail();

        $file = uniqid() . '.pdf';
        file_put_contents($file, file_get_contents($score->score_url));

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($file));
        header('Content-Disposition: attachment; filename=' . basename($score->author->lastname . ' - ' . $score->title . '.pdf'));

        readfile($file);
    }
}
