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
        $scores_similar = Score::where([
            ['author_id', '=', $score->author->id],
            ['id', '<>', $score->id]
            ])->orderBy('avg_votes', 'desc')->orderBy('count_votes', 'desc')->limit(\Config::get('constants.public_scores_maximum_scores_same_author'))->get();

        $score->description = $score['description_' . \App::getLocale()];

        return view('public.score', [
            'breadcrumb_last_level' => $score,
            'score'                 => $score,
            'scores_similar'        => $scores_similar,
            'user_already_vote'     => (bool)$rate
        ]);
    }

    public function showAll()
    {
        $authors = Author::orderBy('lastname')->get();

        return view('public.all_scores', [
            'breadcrumb_last_level' => __('messages.score.all_scores'),
            'authors'               => $authors
        ]);
    }

    public function showLevel($difficulty=null)
    {
        $arr_difficulties = [
            __('generic.sheet_very_easy_href') => ['number' => 1, 'breadcrumb' => __('generic.very_easy')],
            __('generic.sheet_easy_href') => ['number' => 2, 'breadcrumb' => __('generic.easy')],
            __('generic.sheet_intermediate_href') => ['number' => 3, 'breadcrumb' => __('generic.intermediate')],
            __('generic.sheet_hard_href') => ['number' => 4, 'breadcrumb' => __('generic.hard')],
            __('generic.sheet_very_hard_href') => ['number' => 5, 'breadcrumb' => __('generic.very_hard')]
        ];

        if(isset($arr_difficulties[$difficulty]))
        {
            $difficulty = $arr_difficulties[$difficulty];

            $authors = Author::orderBy('lastname')->get();

            return view('public.difficulty', [
                'breadcrumb_last_level' => __('messages.score.all_scores_level', ['level' =>  $difficulty['breadcrumb']]),
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
            'breadcrumb_last_level' => __('nav.request_a_score')
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
            'contact_lastname.required'     => __('error.missed.lastname'),
            'contact_lastname.required'     => __('error.missed.firstname'),
            'contact_email.required'        => __('error.missed.email'),
            'title.required'                => __('error.missed.titre'),
            'author.required'               => __('error.missed.author'),
            'g-recaptcha-response.required' => __('error.missed.captcha'),
            'g-recaptcha-response.captcha'  => __('error.wrong.captcha')
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
            'breadcrumb_last_level' => __('messages.score_request.sent'),
            'sent'                  => true
        ]);
    }

    public function download($slug_score)
    {
        $score = Score::where('slug', '=', $slug_score)->firstOrFail();
        /*
        $file = uniqid() . '.pdf';
        file_put_contents($file, file_get_contents($score->score_url));

        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf', true);
        header('Content-Length: ' . filesize($file));
        header('Content-Disposition: attachment; filename="' . basename($score->author->lastname . ' - ' . $score->title . '.pdf"'));

        readfile($file);
        */

        $score->downloaded = $score->downloaded + 1;
        $score->save();

        return \Redirect::to($score->score_url);
    }
}
