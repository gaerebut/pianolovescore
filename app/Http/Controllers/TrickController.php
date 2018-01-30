<?php

namespace App\Http\Controllers;

use App\Models\Trick;
use App\Models\ScoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TrickController extends Controller
{
    public function show($slug)
    {
        $trick = Trick::where('slug', '=', $slug)->firstOrFail();

        return view('public.trick', [
            'breadcrumb_last_level' => $trick,
            'trick'                 => $trick
        ]);
    }

    public function showAll()
    {
        $tricks = Trick::orderBy('updated_at')->get();

        return view('public.tricks', [
            'breadcrumb_last_level' => 'Toutes les astuces de piano',
            'tricks'                => $tricks
        ]);
    }
}
