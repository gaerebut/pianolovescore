<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Rating;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
    	$input = $request->all();

    	$validator = Validator::make($request->all(), [
    		'slug'	=> 'string|required|max:200',
		    'rate' 	=> 'int|required'
		]);
    	$score = Score::where('slug', '=', $input['slug'])->first();

    	if($score){
    		$ip_address = \Request::ip();
    		$rate = (int)$input['rate'] * 20;

    		$already_rate = Rating::where([
    			['score_id', '=', $score->id],
    			['ip_address', '=', $ip_address]
    		])->first();

    		if(!$already_rate){
                $sum_rates = $score->ratings->sum('rate');

	    		$rating = new Rating();
	    		$rating->score_id = $score->id;
	    		$rating->ip_address = $ip_address;
	    		//$rating->ip_address = '127.0.0.0';
	    		$rating->rate = $rate;
	    		$rating->save();

	    		$score->avg_votes = ($rate + $sum_rates) / ($score->count_votes + 1);
	    		$score->count_votes = $score->count_votes + 1;
	    		$score->save();

	    		$result = ['success' => true, 'avg_votes' => $score->avg_votes, 'count_votes' => $score->count_votes];
	    	}
	    	else{
	    		$result = ['success' => false, 'message' => 'Vous avez déjà noté cette partition'];
	    	}
    	}
    	else{
    		$result = ['success' => false, 'message' => 'La partition demandée est introuvable'];
    	}

    	return $result;
    }
}