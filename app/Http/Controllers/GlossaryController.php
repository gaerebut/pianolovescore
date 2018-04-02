<?php
namespace App\Http\Controllers;

use App\Models\Glossary;

class GlossaryController extends Controller
{
    public function show($letter = 'A')
    {
        $letter = strtoupper($letter[0]);

    	$glossaries = Glossary::where('glossary', 'like', $letter . '%')->orderBy('id')->get();

    	return view('public.glossary', [
    		'breadcrumb_last_level' => 'Lexique en ' . $letter,
            'letter'                => $letter,
            'glossaries'			=> $glossaries
        ]);
    }
}