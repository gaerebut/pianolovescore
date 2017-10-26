<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($composer, $slug)
    {
        // $score = Score::where('slug', '=', $slug)->firstOrFail();
        $score = Score::where('slug', '=', $slug)->first();
        return view('public.score', ['score' => $score]);
    }
}
