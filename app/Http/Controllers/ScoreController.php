<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Rating;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param string  $composer
    *  @param string $slug 
     * @return View
     */
    public function show($composer, $slug)
    {
        $score = Score::where('slug', '=', $slug)->firstOrFail();
        $rate = Rating::where([
            ['score_id', '=', $score->id],
            ['ip_address', '=', \Request::ip()]
        ])->count();

        return view('public.score', ['score' => $score, 'user_already_vote' => (bool)$rate]);
    }

    public function download($slug)
    {
        $score = Score::where('slug', '=', $slug)->firstOrFail();

        $file = uniqid() . '.pdf';
        file_put_contents($file, file_get_contents($score->score_url));

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($file));
        header('Content-Disposition: attachment; filename=' . basename($score->author->lastname . ' - ' . $score->title . '.pdf'));

        readfile($file);
    }
}
