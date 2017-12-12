<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Score;
use App\Models\Comment;
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
    	$request->validate([
    		'slug'	=> 'string|required|max:200',
		    'rate' 	=> 'int|required'
		]);

        $input = $request->all();
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

    public function storeComment(Request $request)
    {

        $request->validate([
            'score_id'      => 'int|required',
            'username'      => 'string|required|max:150',
            'comment'       => 'string|required',
            'comment_id'    => 'int',
        ]);

        $input = $request->all();
        $score = Score::where('id', '=', $input['score_id'])->first();

        if($score){
            $ip_address = \Request::ip();

            $comment = new Comment();
            if(!empty($input['parent_id']))
            {
                $comment->parent_id = $input['parent_id'];
            }
            $comment->score_id = $score->id;
            $comment->ip_address = $ip_address;
            $comment->username = $input['username'];
            $comment->comment = $input['comment'];
            $comment->save();

            $result = ['success' => true, 'id' => $score->id];
        }
        else{
            $result = ['success' => false, 'message' => 'Impossible de poster le commentaire'];
        }

        return $result;
    }
}
