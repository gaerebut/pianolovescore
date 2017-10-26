<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {
        return view('public.score', ['score' => Score::findOrFail($id)]);
    }
}
}
