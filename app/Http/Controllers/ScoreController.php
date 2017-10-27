<?php

namespace App\Http\Controllers;

use App\Models\Score;
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
        return view('public.score', ['score' => $score]);
    }
}
