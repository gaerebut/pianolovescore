<?php

namespace App\Http\Controllers\Admin;

use App\Models\ScoreRequest;
use App\Models\Score;

use App\Mail\ScoreRequestAccepted;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminMasterController as BaseController;

class ScoreRequestController extends BaseController
{
    public function show()
    {
    	$scores_requests = ScoreRequest::where('state', '=', '0')->orderBy('created_at', 'asc')->get();

    	return view('admin.score_request.index', [
    		'breadcrumb_last_level' => 'Demander de partition',
    		'scores_requests' 		=> $scores_requests
        ]);
    }

    public function showEdit($id_scorerequest)
    {
        $score_request = ScoreRequest::where('id', '=', $id_scorerequest)->firstOrFail();
    	$scores = Score::orderBy('title', 'desc')->get();

        return view('admin.score_request.edit', [
            'breadcrumb_last_level' => 'Modifier une demande de partition',
            'score_request'         => $score_request,
            'scores'				=> $scores
        ]);
    }

    public function edit(Request $request)
    {
        $input = $request->all();
        
        $request->validate([    
            'score_id'		    => 'nullable|integer|exists:scores,id',
            'state'             => 'integer',
            'admin_message'     => 'nullable|string',
            'id'   => 'required|exists:scores_requests,id'
        ],[
            'score_id.integer'  => 'L\'identifiant de la partition n\'est pas correcte',
            'score_id.exists'   => 'La partition liée ne semble pas exister',
            'id.required'       => 'L\'identifiant de cette demande de partition est introuvable',
            'id.exists'	        => 'Cette demande de partition est introuvable'
        ]);

        $score_request = ScoreRequest::where('id', '=', $input['id'])->firstOrFail();
        if(!empty($input['score_id']))
        {
            $score_request->score_id    = (int)$input['score_id'];
        }
        $score_request->state           = (int)$input['state'];
        $score_request->admin_message   = $input['admin_message'];
        $score_request->save();

        Mail::to($score_request->contact_email)->send( $score_request->state===1?'accepted':'refused', new ScoreRequest($score_request));

        $this->setFlash( 'success', "La demande de partition vient d'être traitée" );
        return $this->show();
    }


    public function remove($id_scorerequest)
    {
        if(ScoreRequest::where('id', '=', $id_scorerequest)->delete())
        {
            $this->setFlash( 'success', "La demande de partition vient d'être traitée" );
        }
        else
        {
            $this->setFlash( 'error', "Cette demande de partition est introuvable" );
        }

        return back();
    }
}
