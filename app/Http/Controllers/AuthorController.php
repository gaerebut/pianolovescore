<?php

namespace App\Http\Controllers;

use \App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function showScores($composer_slug)
    {
        $author = Author::where('slug', '=', $composer_slug)->firstOrFail();
        return view('public.author', [
            'breadcrumb_last_level' => $author->fullname,
            'author' => $author
        ]);
    }
}
