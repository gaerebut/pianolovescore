<?php
namespace App\Http\Controllers\Admin;

use App\Models\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminMasterController as BaseController;

class AuthorController extends BaseController
{
    public function show()
    {
    	$authors = Author::orderBy('lastname')->get();

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
        $author->slug 	= ucfirst($input['slug']);
        $author->lastname 	= ucfirst($input['lastname']);
        $author->firstname 	= ucfirst($input['firstname']);
        $author->fullname 	= $author->firstname . ' ' . $author->lastname;
        $author->birthday 	= $input['birthday'];
        $author->save();

        $this->setFlash( 'success', "L'auteur vient d'être créé" );
        return $this->show();
    }

    public function showEdit($slug_author)
    {

    }

    public function edit(Request $request)
    {

    }

    public function remove($slug_author)
    {

    }
}
