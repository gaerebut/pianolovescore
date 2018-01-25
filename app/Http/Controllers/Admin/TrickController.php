<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trick;
use App\Scopes\IsOnlineScope;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminMasterController as BaseController;


class TrickController extends BaseController
{
    public function show()
    {
    	$tricks = Trick::withoutGlobalScope(IsOnlineScope::class)->orderBy('id')->get();

    	return view('admin.trick.index', [
    		'breadcrumb_last_level' => 'Astuces',
            'tricks'				=> $tricks
        ]);
    }

    public function showAdd()
    {
    	return view('admin.trick.add', [
    		'breadcrumb_last_level' => 'Ajouter une astuce'
        ]);
    }

    public function add(Request $request)
    {
    	$input = $request->all();

    	$request->validate([    
            'title'			=> 'required',
            'slug'			=> 'required|unique:tricks,slug',
            'introduction' 	=> 'required',
            'description'   => 'required'
        ],[
            'title.required'		=> 'Veuillez indiquer le titre de l\'astuce',
            'slug.required'			=> 'Veuillez indiquer l\'identifiant URL',
            'introduction.required' => 'Veuillez indiquer un texte d\'introduction',
            'description.required'	=> 'Veuillez indiquer une description',
        ]);

        $trick = new Trick();
        $trick->title 				= ucfirst($input['title']);
        $trick->introduction        = $input['introduction'];
        $trick->description         = $input['description'];
        $trick->slug 				= ucfirst($input['slug']);
        $trick->is_online           = !empty($input['is_online']);
        $trick->save();

        $this->setFlash( 'success', 'L\'actuce vient d\'être créée' );
        return $this->show();
    }

    public function showEdit($id_trick)
    {
        $trick = Trick::withoutGlobalScope(IsOnlineScope::class)->where('id', '=', $id_trick)->firstOrFail();
        if($trick)
        {
            return view('admin.trick.edit', [
                'breadcrumb_last_level' => 'Modifier une astuce',
                'trick'                	=> $trick
            ]);
        }
        else
        {
            $this->setFlash( 'error', 'Cette astuce est introuvable' );
        }
    }

    public function edit(Request $request)
    {
        $input = $request->all();
        
        $request->validate([    
            'title'         => 'required',
            'slug'          => 'required|unique:tricks,slug',
            'introduction'  => 'required',
            'description'   => 'required'
        ],[
            'title.required'        => 'Veuillez indiquer le titre de l\'astuce',
            'slug.required'         => 'Veuillez indiquer l\'identifiant URL',
            'introduction.required' => 'Veuillez indiquer un texte d\'introduction',
            'description.required'  => 'Veuillez indiquer une description',
        ]);

        $trick = Trick::withoutGlobalScope(IsOnlineScope::class)->where('id', '=', $input['id'])->firstOrFail();
        $trick->title               = ucfirst($input['title']);
        $trick->introduction        = $input['introduction'];
        $trick->description         = $input['description'];
        $trick->slug                = ucfirst($input['slug']);
        $trick->is_online           = !empty($input['is_online']);
        $trick->save();

        $this->setFlash( 'success', 'L\astuce vient d\'être modifiée' );
        return $this->show();
    }

    public function remove($id_trick)
    {
        if(Trick::withoutGlobalScope(IsOnlineScope::class)->where('id', '=', $id_trick)->delete())
        {
            $this->setFlash( 'success', 'L\'astuce vient d\'être supprimée' );
        }
        else
        {
            $this->setFlash( 'error', 'Impossible de supprimer cette astuce' );
        }

        return back();
    }
}
