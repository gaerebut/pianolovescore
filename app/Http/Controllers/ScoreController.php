<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Rating;
use App\Models\Author;
use App\Models\ScoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ScoreController extends Controller
{
    public function show($composer_slug, $score_slug)
    {
        $score = Score::where('slug', '=', $score_slug)->firstOrFail();
        $rate = Rating::where([
            ['score_id', '=', $score->id],
            ['ip_address', '=', \Request::ip()]
        ])->count();

        return view('public.score', [
            'breadcrumb_last_level' => $score,
            'score'                 => $score,
            'user_already_vote'     => (bool)$rate
        ]);
    }

    public function showAll()
    {
        $authors = Author::orderBy('lastname')->get();

        return view('public.all_scores', [
            'breadcrumb_last_level' => 'Toutes les partitions gratuites de piano',
            'authors'               => $authors
        ]);
    }

    public function showLevel($difficulty=null)
    {
        $arr_difficulties = [
            'tres-faciles' => ['number' => 1, 'breadcrumb' => 'très faciles'],
            'faciles' => ['number' => 2, 'breadcrumb' => 'faciles'],
            'intermediaires' => ['number' => 3, 'breadcrumb' => 'intermédiaires'],
            'difficiles' => ['number' => 4, 'breadcrumb' => 'difficiles'],
            'tres-difficiles' => ['number' => 5, 'breadcrumb' => 'très difficiles']
        ];

        if(isset($arr_difficulties[$difficulty]))
        {
            $difficulty = $arr_difficulties[$difficulty];

            $authors = Author::orderBy('lastname')->get();

            return view('public.difficulty', [
                'breadcrumb_last_level' => 'Les partitions gratuites ' . $difficulty['breadcrumb'],
                'authors'               => $authors,
                'difficulty'            => $difficulty['breadcrumb'],
                'difficulty_number'     => $difficulty['number']
            ]);
        }
        else
        {
            abort(404);
        }

    }

    public function requestShow()
    {
        return view('public.score_request', [
            'breadcrumb_last_level' => 'Demander une partition'
        ]);
    }

    public function requestSave(Request $request)
    {
        $request->validate([    
            'contact_lastname'      => 'required',
            'contact_firstname'     => 'required',
            'contact_email'         => 'required',
            'title'                 => 'required',
            'author'                => 'required',
            'g-recaptcha-response'  => 'required|captcha'
        ],[
            'contact_lastname.required'     => 'Veuillez indiquer votre nom',
            'contact_lastname.required'     => 'Veuillez indiquer votre prénom',
            'contact_email.required'        => 'Veuillez indiquer votre adresse email',
            'title.required'                => 'Veuillez indiquer un titre',
            'author.required'               => 'Veuillez indiquer un auteur',
            'g-recaptcha-response.required' => 'Veuillez confirmer que vous n\'êtes pas un robot',
            'g-recaptcha-response.captcha'  => 'La confirmation anti-robot a échoué. Veuillez réessayer.'
        ]);
        $input = $request->all();

        $score_request = new ScoreRequest();
        $score_request->title               = $input['title'];
        $score_request->author              = $input['author'];
        $score_request->contact_lastname    = $input['contact_lastname'];
        $score_request->contact_firstname   = $input['contact_firstname'];
        $score_request->contact_email       = $input['contact_email'];
        $score_request->save();

        return view('public.score_request', [
            'breadcrumb_last_level' => 'Demande de partition envoyée',
            'sent'                  => true
        ]);
    }

    public function download($slug_score)
    {
        $score = Score::where('slug', '=', $slug_score)->firstOrFail();

        $file = uniqid() . '.pdf';
        file_put_contents($file, file_get_contents($score->score_url));

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($file));
        header('Content-Disposition: attachment; filename=' . basename($score->author->lastname . ' - ' . $score->title . '.pdf'));

        readfile($file);

        $score->downloaded = $score->downloaded + 1;
        $score->save();
    }
}
