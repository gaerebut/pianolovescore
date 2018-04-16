<?php
namespace App\Http\Controllers;

use App\Models\Glossary;

class GlossaryController extends Controller
{
    public function show($letter = 'A')
    {
        $letter = strtoupper($letter[0]);

    	$glossaries = Glossary::where('glossary_' . \App::getLocale(), 'like', $letter . '%')->orderBy('id')->get();

    	return view('public.glossary', [
    		'breadcrumb_last_level' => __('messages.glossary.in', ['letter' => $letter]),
            'letter'                => $letter,
            'glossaries'			=> $glossaries
        ]);
    }
}