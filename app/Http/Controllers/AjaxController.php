<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Rating;
use App\Models\Score;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /**
     * Rating a score
     *
     * @param  Request $request
     * @return Response
     */
    public function storeRating(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'slug'	=> 'string|required|max:200',
		    'rate' 	=> 'int|required'
		]);

    	$score = Score::where('slug', '=', $request->slug)->first();

    	if($score){
    		$ip_address = Request::ip();
    		$rate = $request->rate * 20;

    		$already_rate = Rating::where([
    			['score_id', '=', $score->id],
    			['ip_address', '=', $ip_address]
    		])->first();

    		if(!$already_rate){
	    		$rating = new Rating();
	    		$rating->scoreId = $score->id;
	    		$rating->ipAddress = $ip_address;
	    		$rating->rate = $rate;
	    		$rate->save();

	    		$score->avg_votes = (($score->avg_votes * $score->count_votes) + $rate) / ($score->count_votes + 1);
	    		$score->count_votes = $score->count_votes + 1;
	    		$score->save();
	    	}
    	}
    }
}
