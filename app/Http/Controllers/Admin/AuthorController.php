<?php
namespace App\Http\Controllers\Admin;

use App\Models\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminMasterController as BaseController;

class AuthorController extends BaseController
{
    public function show()
    {
    	$authors = Author::orderBy('id')->get();

    	return view('admin.author.index', [
    		'breadcrumb_last_level' => 'Auteurs',
            'authors'				=> $authors
        ]);
    }

    public function showAdd()
    {
    	return view('admin.author.add', [
    		'breadcrumb_last_level' => 'Ajouter un auteur'
        ]);
    }

    public function add(Request $request)
    {
    	$request->validate([    
            'lastname'	=> 'required',
            'firstname'	=> 'required',
            'slug'      => 'required|unique:authors,slug',
            'birthday'  => 'required'
        ],[
            'lastname.required'	=> 'Veuillez indiquer le nom de l\'auteur',
            'firstname.required'=> 'Veuillez indiquer le prénom de l\'auteur',
            'slug.required'		=> 'Veuillez indiquer l\'identifiant URL',
            'slug.unique'		=> 'Cet identifiant URL existe déjà, veuillez en choisir un autre',
            'birthday.required'	=> 'Veuillez indiquer la date de naisse de l\'auteur',
        ]);
        $input = $request->all();

        $author = new Author();
        $author->slug           = ucfirst($input['slug']);
        $author->description_fr = $input['description_fr'];
        $author->description_en = $input['description_en'];
        $author->lastname       = ucfirst($input['lastname']);
        $author->firstname 	    = ucfirst($input['firstname']);
        $author->fullname 	    = $author->firstname . ' ' . $author->lastname;
        $author->birthday 	    = $input['birthday'];
        $author->save();

        $this->setFlash( 'success', "L'auteur vient d'être créé" );
        return $this->show();
    }

    public function showEdit($id_author)
    {
        $author = Author::where('id', $id_author)->firstOrFail();
       
        if($author)
        {
            return view('admin.author.edit', [
                'breadcrumb_last_level' => 'Modifier un auteur',
                'author'                => $author
            ]);
        }
        else
        {
            $this->setFlash( 'error', "Cet auteur est introuvable" );
        }
    }

    public function edit(Request $request)
    {
        $input = $request->all();

        $request->validate([    
            'lastname'  => 'required',
            'firstname' => 'required',
            'slug'      => 'required|unique:authors,slug,' . $input['id'],
            'birthday'  => 'required'
        ],[
            'lastname.required' => 'Veuillez indiquer le nom de l\'auteur',
            'firstname.required'=> 'Veuillez indiquer le prénom de l\'auteur',
            'slug.required'     => 'Veuillez indiquer l\'identifiant URL',
            'slug.unique'       => 'Cet identifiant URL existe déjà, veuillez en choisir un autre',
            'birthday.required' => 'Veuillez indiquer la date de naisse de l\'auteur',
        ]);
        

        $author = Author::where('id', '=', $input['id'])->firstOrFail();
        $author->slug           = ucfirst($input['slug']);
        $author->description_fr = $input['description_fr'];
        $author->description_en = $input['description_en'];
        $author->lastname       = ucfirst($input['lastname']);
        $author->firstname      = ucfirst($input['firstname']);
        $author->fullname       = $author->firstname . ' ' . $author->lastname;
        $author->birthday       = $input['birthday'];
        $author->save();

        $this->setFlash( 'success', "L'auteur vient d'être modifié" );
        return $this->show();
    }

    public function remove($id_author)
    {
        if(Author::where('id', '=', $id_author)->delete())
        {
            $this->setFlash( 'success', "L'auteur vient d'être supprimé" );
        }
        else
        {
            $this->setFlash( 'error', "Impossible de supprimer cet auteur" );
        }

        return back();
    }
}
