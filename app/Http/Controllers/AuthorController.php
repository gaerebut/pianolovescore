<?php

namespace App\Http\Controllers;

use \App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function showScores($slug_author)
    {
        $author = Author::where('slug', '=', $slug_author)->firstOrFail();
        $author->description = $author['description_' . \App::getLocale()];
        return view('public.author', [
            'breadcrumb_last_level' => $author->fullname,
            'author' => $author
        ]);
    }
}
