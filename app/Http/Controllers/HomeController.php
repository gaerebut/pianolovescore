<?php

namespace App\Http\Controllers;

use \App\Models\Score;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show()
    {
    	$scores_new = Score::orderBy('created_at', 'desc')->limit(\Config::get('constants.public_scores_maximum_home'))->get();
    	$scores_top = Score::orderBy('avg_votes', 'desc')->orderBy('count_votes', 'desc')->limit(\Config::get('constants.public_scores_maximum_home'))->get();
        return view('public.home', [
            'scores_new' => $scores_new,
            'scores_top' => $scores_top
        ]);
    }
}
