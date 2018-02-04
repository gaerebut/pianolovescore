<?php

namespace App\Http\Controllers\Admin;

use App\Models\Score;
use App\Models\Author;
use App\Models\Keyword;
use App\Scopes\IsOnlineScope;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminMasterController as BaseController;
use File;

class ScoreController extends BaseController
{
    public function show()
    {
    	$scores = Score::withoutGlobalScope(IsOnlineScope::class)->orderBy('id', 'desc')->get();

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
            'difficulty'    => 'required',
            'author_id'     => 'required|exists:authors,id',
            'score_image'  	=> 'required',
            'score_url'  	=> 'required'
        ],[
            'title.required'		=> 'Veuillez indiquer le titre de la partition',
            'slug.required'			=> 'Veuillez indiquer l\'identifiant URL',
            'slug.unique'      		=> 'Cet identifiant URL existe déjà, veuillez en choisir un autre',
            'keywords.required'     => 'Veuillez indiquer les mots clés',
            'difficilty.required'	=> 'Veuillez indiquer une difficulté pour la partition',
            'author_id.required'	=> 'Veuillez indiquer un auteur pour la partition',
            'author_id.exists'		=> 'L\'auteur choisi pour la partition ne semble pas exister',
            'score_image.required'	=> 'Veuillez indiquer l\'url de la miniature de la partition',
            'score_url.required'	=> 'Veuillez indiquer l\'url du fichier PDF de la partition',
        ]);

        $author = Author::where('id', '=', $input['author_id'])->firstOrFail();
        
        if(!is_dir('img/scores/' . $author->slug))
        {
            File::makeDirectory('img/scores/' . $author->slug , 0777, true);
        }

        $extension = explode('.', $input['score_image']);
        $score_image = $author->slug . '/' . $input['slug'] . '.' . $extension[count($extension)-1];

        file_put_contents('img/scores/' . $score_image, file_get_contents($input['score_image']));

        $score = new Score();
        $score->title 				= ucfirst($input['title']);
        $score->description         = $input['description'];
        $score->slug 				= ucfirst($input['slug']);
        $score->author_id			= $input['author_id'];
        $score->is_online           = !empty($input['is_online']);
        $score->score_image			= $score_image;
        $score->score_url			= $input['score_url'];
        $score->score_sound_url		= $input['score_sound_url'];
        $score->difficulty          = $input['difficulty'];
        $score->nb_pages            = $input['nb_pages'];

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
        $keywords = array_map('trim', $keywords);

        foreach($keywords as $word)
        {
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
        $score = Score::withoutGlobalScope(IsOnlineScope::class)->where('id', '=', $id_score)->firstOrFail();
        if($score)
        {
        	$authors = Author::orderBy('lastname')->get();

            return view('admin.score.edit', [
                'breadcrumb_last_level' => 'Modifier une partition',
                'score'                	=> $score,
                'authors'				=> $authors
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
            'difficulty'    => 'required',
            'author_id'     => 'required|exists:authors,id',
            'score_url'  	=> 'required'
        ],[
            'title.required'		=> 'Veuillez indiquer le titre de la partition',
            'slug.required'			=> 'Veuillez indiquer l\'identifiant URL',
            'slug.unique'      		=> 'Cet identifiant URL existe déjà, veuillez en choisir un autre',
            'keywords.required'		=> 'Veuillez indiquer les mots clés',
            'difficilty.required'   => 'Veuillez indiquer une difficulté pour la partition',
            'author_id.required'	=> 'Veuillez indiquer un auteur pour la partition',
            'author_id.exists'		=> 'L\'auteur choisi pour la partition ne semble pas exister',
            'score_url.required'	=> 'Veuillez indiquer l\'url du fichier PDF de la partition',
        ]);

        $score = Score::withoutGlobalScope(IsOnlineScope::class)->where('id', '=', $input['id'])->firstOrFail();
        
        $author = Author::where('id', '=', $input['author_id'])->firstOrFail();
        
        if(!is_dir('img/scores/' . $author->slug))
        {
            File::makeDirectory('img/scores/' . $author->slug , 0777, true);
        }

        $score_image = $score->score_image;

        if(!empty($input['score_image']))
        {
            $extension = explode('.', $input['score_image']);
            $score_image = $author->slug . '/' . $input['slug'] . '.' . $extension[count($extension)-1];

            file_put_contents('img/scores/' . $score_image, file_get_contents($input['score_image']));
            chmod('img/scores/' . $score_image, 0777);

            if($score_image != $score->score_image)
            {
                File::delete('img/scores/' . $score->score_image);
            }
        }
        else if($score->slug != $input['slug'] || $score->author->id != $input['author_id'])
        {
            $extension = explode('.', $score->score_image); // extension of existing image file
            $score_image = $author->slug . '/' . $input['slug'] . '.' . $extension[count($extension)-1];

            File::move('img/scores/' . $score->score_image, 'img/scores/' . $score_image);
        }

        $score->title 				= ucfirst($input['title']);
        $score->description         = $input['description'];
        $score->slug 				= ucfirst($input['slug']);
        $score->author_id			= $input['author_id'];
        $score->is_online           = !empty($input['is_online']);
        $score->score_image			= $score_image;
        $score->score_url			= $input['score_url'];
        $score->score_sound_url		= $input['score_sound_url'];
        $score->difficulty          = $input['difficulty'];
        $score->nb_pages            = $input['nb_pages'];

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
        $keywords = array_map('trim', $keywords);

        foreach($score->keywords as $keyword)
        {
        	if(!in_array($keyword, $keywords))
        	{
        		$score->keywords()->detach($keyword->id);
        	}
        }

        foreach($keywords as $word)
        {
         	$keyword = Keyword::where('keyword', '=', $word)->first();

        	if(!$keyword)
        	{
	        	$keyword = new Keyword();
	        	$keyword->keyword = trim($word);
	        	$keyword->save();
			}

			$attach = true;
			foreach($score->keywords as $current_keyword)
			{
				if($current_keyword->keyword == $keyword)
				{
					$attach = false;
					break;
				}
			}

			if($attach)
			{
				$score->keywords()->attach($keyword);
			}
        }

        $this->setFlash( 'success', "La partition vient d'être modifiée" );
        return $this->show();
    }

    public function remove($id_score)
    {
        if(Score::withoutGlobalScope(IsOnlineScope::class)->where('id', '=', $id_score)->delete())
        {
            $this->setFlash( 'success', "La partition vient d'être supprimée" );
        }
        else
        {
            $this->setFlash( 'error', "Impossible de supprimer cette partition" );
        }

        return back();
    }
}
