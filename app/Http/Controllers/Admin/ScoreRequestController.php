<?php

namespace App\Http\Controllers\Admin;

use App\Models\ScoreRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminMasterController as BaseController;

class ScoreRequestController extends BaseController
{
    public function show()
    {
    	$scores_requests = ScoreRequest::orderBy('created_at', 'desc')->get();

    	return view('admin.score_request.index', [
    		'breadcrumb_last_level' => 'Demander de partition',
    		'scores_requests' 		=> $scores_requests
        ]);
    }
}
