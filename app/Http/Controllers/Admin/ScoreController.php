<?php

namespace App\Http\Controllers\Admin;

use App\Models\Score;
use App\Models\Author;
use App\Models\Keyword;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminMasterController as BaseController;

class ScoreController extends BaseController
{
    public function show()
    {
    	$scores = Score::orderBy('id')->get();

    	return view('admin.score.index', [
    		'breadcrumb_last_level' => 'Partitions',
            'scores'				=> $scores
        ]);
    }

    public function showAdd()
    {
    	$authors = Author::orderBy('lastname')->get();
    	return view('admin.score.add', [
    		'breadcrumb_last_level' => 'Ajouter une partition',
    		'authors'				=> $authors
        ]);
    }

    public function add(Request $request)
    {
    	$input = $request->all();

    	$request->validate([    
            'title'			=> 'required',
            'slug'			=> 'required|unique:scores,slug',
            'keywords'  	=> 'required',
            'author_id'     => 'required|exists:authors,id',
            'score_image'  	=> 'required',
            'score_url'  	=> 'required'
        ],[
            'title.required'		=> 'Veuillez indiquer le titre de la partition',
            'slug.required'			=> 'Veuillez indiquer l\'identifiant URL',
            'slug.unique'      		=> 'Cet identifiant URL existe déjà, veuillez en choisir un autre',
            'keywords.required'		=> 'Veuillez indiquer les mots clés',
            'author_id.required'	=> 'Veuillez indiquer un auteur pour la partition',
            'author_id.exists'		=> 'L\'auteur choisi pour la partition ne semble pas exister',
            'score_image.required'	=> 'Veuillez indiquer l\'url de la miniature de la partition',
            'score_url.required'	=> 'Veuillez indiquer l\'url du fichier PDF de la partition',
        ]);

        $score = new Score();
        $score->title 				= ucfirst($input['title']);
        $score->slug 				= ucfirst($input['slug']);
        $score->author_id			= $input['author_id'];
        $score->score_image			= $input['score_image'];
        $score->score_url			= $input['score_url'];
        $score->score_sound_url		= $input['score_sound_url'];

        if(!empty($input['score_sound_url']))
        {
	        $score->score_sound_format	= pathinfo(parse_url($input['score_sound_url'])['path'], PATHINFO_EXTENSION);
	    }
	    else
	    {
	    	$score->score_sound_format = null;
	    }

        $score->save();

        $keywords = explode(",",strtolower($input['keywords']));
        foreach($keywords as $word)
        {
        	$word = trim($word);

        	$keyword = Keyword::where('keyword', '=', $word)->first();

        	if(!$keyword)
        	{
	        	$keyword = new Keyword();
	        	$keyword->keyword = trim($word);
	        	$keyword->save();
	        }
	        
		    $score->keywords()->attach($keyword);
        }

        $this->setFlash( 'success', "La partition vient d'être créée" );
        return $this->show();
    }

    public function showEdit($id_score)
    {
        $score = Score::where('id', '=', $id_score)->firstOrFail();
        if($score)
        {
            return view('admin.score.edit', [
                'breadcrumb_last_level' => 'Modifier une partition',
                'score'                => $score
            ]);
        }
        else
        {
            $this->setFlash( 'error', "Cette partition est introuvable" );
        }
    }

    public function edit(Request $request)
    {
        $input = $request->all();
        
        $request->validate([    
            'title'			=> 'required',
            'slug'			=> 'required|unique:scores,slug,' . $input['id'],
            'keywords'  	=> 'required',
            'author_id'     => 'required|exists:authors,id,' . $input['author_id'],
            'score_image'  	=> 'required',
            'score_url'  	=> 'required'
        ],[
            'title.required'		=> 'Veuillez indiquer le titre de la partition',
            'slug.required'			=> 'Veuillez indiquer l\'identifiant URL',
            'slug.unique'      		=> 'Cet identifiant URL existe déjà, veuillez en choisir un autre',
            'keywords.required'		=> 'Veuillez indiquer les mots clés',
            'author_id.required'	=> 'Veuillez indiquer un auteur pour la partition',
            'author_id.exists'		=> 'L\'auteur choisi pour la partition ne semble pas exister',
            'score_image.required'	=> 'Veuillez indiquer l\'url de la miniature de la partition',
            'score_url.required'	=> 'Veuillez indiquer l\'url du fichier PDF de la partition',
        ]);

        $score = Score::where('id', '=', $input['id'])->firstOrFail();
        $score->title 				= ucfirst($input['title']);
        $score->slug 				= ucfirst($input['slug']);
        $score->author_id			= $input['author_id'];
        $score->score_image			= $input['score_image'];
        $score->score_url			= $input['score_url'];
        $score->score_sound_url		= $input['score_sound_url'];
        if(!empty($input['score_sound_url']))
        {
	        $score->score_sound_format	= pathinfo(parse_url($input['score_sound_url'])['path'], PATHINFO_EXTENSION);
	    }
	    else
	    {
	    	$score->score_sound_format = null;
	    }
        $score->save();

        $keywords = explode(",",strtolower($input['keywords']));
        foreach($score->keywords as $keyword)
        {
        	if(!in_array(trim($keyword), $keywords))
        	{
        		$score->keywords->detach($keyword->id);
        	}
        }

        foreach($keywords as $word)
        {
        	$keyword = new Keyword();
        	$keyword->keyword = $word;
        	if($keyword->save())
        	{
	        	$score->keywords->attach($keyword->id);
	        }
        }

        $this->setFlash( 'success', "La partition vient d'être modifiée" );
        return $this->show();
    }

    public function remove($id_score)
    {
        if(Score::where('id', '=', $id_score)->delete())
        {
            $this->setFlash( 'success', "La partition vient d'être créée" );
        }
        else
        {
            $this->setFlash( 'error', "Cette partition est introuvable" );
        }

        return back();
    }
}
