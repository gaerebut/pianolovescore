<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Scopes\IsOnlineScope;
use App\Http\Controllers\Admin\AdminMasterController as BaseController;

class CommentController extends BaseController
{
    public function show()
    {
        $new_comments = Comment::withoutGlobalScope(IsOnlineScope::class)->where('is_new', 1)->orderBy('created_at', 'desc')->get();
    	$old_comments = Comment::withoutGlobalScope(IsOnlineScope::class)->where('is_new', 0)->orderBy('created_at', 'desc')->get();

    	return view('admin.comment.index', [
    		'breadcrumb_last_level' => 'Commentaires',
            'new_comments'          => $new_comments,
            'old_comments'			=> $old_comments
        ]);
    }

    public function setOnline($id_comment)
    {
        $comment = Comment::withoutGlobalScope(IsOnlineScope::class)->where('id', '=', $id_comment)->firstOrFail();
        if($comment)
        {
            $comment->is_online     = true;
        	$comment->is_new       = false;
            $comment->save();

            $this->setFlash( 'success', "Le commentaire vient d'être mis en ligne" );
        }
        else
        {
            $this->setFlash( 'error', "Ce commentaire est introuvable" );
        }

        return back();
    }

    public function setOffline($id_comment)
    {
        $comment = Comment::withoutGlobalScope(IsOnlineScope::class)->where('id', '=', $id_comment)->firstOrFail();
        if($comment)
        {
            $comment->is_online    = false;
            $comment->is_new       = false;
            $comment->save();

            $this->setFlash( 'success', "Le commentaire vient d'être mis hors ligne" );
        }
        else
        {
            $this->setFlash( 'error', "Ce commentaire est introuvable" );
        }

        return back();
    }



    public function remove($id_comment)
    {
        if(Comment::where('id', '=', $id_comment)->delete())
        {
            $this->setFlash( 'success', "Le commentaire vient d'être supprimé" );
        }
        else
        {
            $this->setFlash( 'error', "Impossible de supprimer ce commentaire" );
        }

        return back();
    }
}
