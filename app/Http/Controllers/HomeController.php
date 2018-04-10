<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Contactus;

use Illuminate\Support\Facades\Mail;
use App\Models\Score;
use App\Models\Author;
use App\Models\Trick;

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

    public function contactusShow()
    {
        return view('public.contactus', [
            'breadcrumb_last_level' => __('nav.contact_us')
        ]);
    }

    public function contactusSave(Request $request)
    {
        $request->validate([    
            'contact_lastname'      => 'required',
            'contact_firstname'     => 'required',
            'contact_email'         => 'required',
            'subject'				=> 'required',
            'message'				=> 'required',
            'g-recaptcha-response'  => 'required|captcha'
        ],[
            'contact_lastname.required'     => __('error.missed.lastname'),
            'contact_lastname.required'     => __('error.missed.firstname'),
            'contact_email.required' 		=> __('error.missed.email'),
            'subject.required'              => __('error.missed.object'),
            'message.required'              => __('error.missed.message'),
            'g-recaptcha-response.required' => __('error.missed.captcha'),
            'g-recaptcha-response.captcha'  => __('error.wrong.captcha')
        ]);

        Mail::to( 'gaetan.rebut@gmail.com' )->send( new Contactus($request->all()));

        return view('public.contactus', [
            'breadcrumb_last_level' => __('messages.contact.sent'),
            'sent'                  => true
        ]);
    }

    public function searchByForm(Request $request)
    {
       return $this->search($request->all()['q']);
    }

    public function search($keywords)
    {
        $scores = Score::search($keywords)->get();
        $authors = Author::search($keywords)->get();
        $tricks = Trick::search($keywords)->get();
        
        return view('public.search', [
            'breadcrumb_last_level' => __('messages.search_free_sheet'),
            'keywords'              => $keywords,
            'scores'                => $scores,
            'authors'               => $authors,
            'tricks'                => $tricks
        ]);
    }
}
