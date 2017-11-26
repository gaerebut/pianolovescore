<?php

namespace App\Http\Controllers\Admin;

use Imagick;
use App\Models\Score;
use App\Models\Author;
use App\Models\Keyword;
use App\Scopes\IsOnlineScope;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminMasterController as BaseController;

class ScoreController extends BaseController
{
    public function show()
    {
    	$scores = Score::withoutGlobalScope(IsOnlineScope::class)->orderBy('id')->get();

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
        $score->description         = $input['description'];
        $score->slug 				= ucfirst($input['slug']);
        $score->author_id			= $input['author_id'];
        $score->is_online           = !empty($input['is_online']);
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

        $score = Score::withoutGlobalScope(IsOnlineScope::class)->where('id', '=', $input['id'])->firstOrFail();
        $score->title 				= ucfirst($input['title']);
        $score->description         = $input['description'];
        $score->slug 				= ucfirst($input['slug']);
        $score->author_id			= $input['author_id'];
        $score->is_online           = !empty($input['is_online']);
        $score->score_image			= $input['score_image'];
        $score->score_url			= $input['score_url'];
        $score->score_sound_url		= $input['score_sound_url'];
        $score->nb_pages            = $this->getPDFPages($input['score_url']);

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
            $this->setFlash( 'success', "La partition vient d'être créée" );
        }
        else
        {
            $this->setFlash( 'error', "Cette partition est introuvable" );
        }

        return back();
    }

    private function getPDFPages($document)
    {
        ini_set('memory_limit','256M');
        
        $fp = @fopen(preg_replace("/\[(.*?)\]/i", "",$document),"r");
        $max=0;
        while(!feof($fp)) {
            $line = fgets($fp,255);
            if (preg_match('/\/Count [0-9]+/', $line, $matches))
            {
                preg_match('/[0-9]+/',$matches[0], $matches2);
                if ($max<$matches2[0]) $max=$matches2[0];
            }
        }
        fclose($fp);
        if($max==0)
        {
            $im = new imagick($document);
            $max=$im->getNumberImages();
        }

        return $max;
    }
}
