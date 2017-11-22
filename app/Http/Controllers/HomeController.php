<?php

namespace App\Http\Controllers;

use \App\Models\Score;
use Illuminate\Http\Request;

use App\Mail\Contactus;

use Illuminate\Support\Facades\Mail;

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
            'breadcrumb_last_level' => 'Contactez-nous'
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
            //'g-recaptcha-response'  => 'required|captcha'
        ],[
            'contact_lastname.required'     => 'Veuillez indiquer votre nom',
            'contact_lastname.required'     => 'Veuillez indiquer votre prénom',
            'contact_email.required' 		=> 'Veuillez indiquer votre adresse email',
            'subject.required'              => 'Veuillez indiquer un objet',
            'message.required'              => 'Veuillez indiquer un message',
            //'g-recaptcha-response.required' => 'Veuillez confirmer que vous n\'êtes pas un robot',
            //'g-recaptcha-response.captcha'  => 'La confirmation anti-robot a échoué. Veuillez réessayer.'
        ]);

        Mail::to( 'gaetan.rebut@gmail.com' )->send( new Contactus($request->all()));

        return view('public.contactus', [
            'breadcrumb_last_level' => 'Demande de contact envoyée',
            'sent'                  => true
        ]);
    }
}
