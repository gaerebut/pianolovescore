<?php
namespace App\Http\Controllers\Admin;

use App\Models\Glossary;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminMasterController as BaseController;
use File;

class GlossaryController extends BaseController
{
    public function show($letter = 'A')
    {
        $letter = strtoupper($letter[0]);

    	$glossaries = Glossary::where('glossary', 'like', $letter . '%')->orderBy('id')->get();

    	return view('admin.glossary.index', [
    		'breadcrumb_last_level' => 'Lexique en ' . $letter,
            'letter'                => $letter,
            'glossaries'			=> $glossaries
        ]);
    }

    public function add(Request $request)
    {
    	$request->validate([    
            'glossary'      => 'required',
            'description'   => 'required',
            'slug'          => 'required|unique:glossaries,slug'
        ],[
            'glossary.required'	    => 'Veuillez indiquer le mot à ajouter au lexique',
            'description.required'  => 'Veuillez mettre une description pour ce mot',
            'slug.required'		    => 'Veuillez indiquer l\'identifiant URL',
            'slug.unique'		    => 'Cet identifiant URL existe déjà, veuillez en choisir un autre',
        ]);
        $input = $request->all();

        $glossary_image = null;
        if(!is_null($input['image']))
        {
            $extension = explode('.', $input['image']);
            $glossary_image = $input['slug'] . '.' . $extension[count($extension)-1];

            file_put_contents('img/glossaries/' . $glossary_image, file_get_contents($input['image']));
        }

        $glossary = new Glossary();
        $glossary->glossary         = ucfirst($input['glossary']);
        $glossary->slug             = ucfirst($input['slug']);
        $glossary->description      = $input['description'];
        $glossary->image            = $glossary_image;
        $glossary->save();

        $this->setFlash( 'success', "Le mot vient d'être ajouté au lexique" );
        return $this->show();
    }

    public function edit(Request $request)
    {
        $input = $request->all();

        $request->validate([    
            'glossary'      => 'required',
            'description'   => 'required',
            'slug'          => 'required|unique:glossaries,slug,' . $input['id']
        ],[
            'glossary.required'     => 'Veuillez indiquer le mot à ajouter au lexique',
            'description.required'  => 'Veuillez mettre une description pour ce mot',
            'slug.required'         => 'Veuillez indiquer l\'identifiant URL',
            'slug.unique'           => 'Cet identifiant URL existe déjà, veuillez en choisir un autre',
        ]);
        

        $glossary = Glossary::where('id', '=', $input['id'])->firstOrFail();

        $glossary_image = null;

        if(!empty($input['image']))
        {
            $extension = explode('.', $input['image']);
            $glossary_image = $input['slug'] . '.' . $extension[count($extension)-1];

            file_put_contents('img/glossaries/' . $glossary_image, file_get_contents($input['image']));
            chmod('img/glossaries/' . $glossary_image, 0777);

            if($glossary_image != $glossary->image)
            {
                File::delete('img/glossaries/' . $glossary->image);
            }
        }
        else if($glossary->slug != $input['slug'])
        {
            $extension = explode('.', $glossary->image); // extension of existing image file
            $glossary_image = $input['slug'] . '.' . $extension[count($extension)-1];

            File::move('img/glossaries/' . $glossary->image, 'img/glossaries/' . $glossary_image);
        }
        else if(isset($input['delete_image']) && is_file('img/glossaries/' . $glossary->image))
        {
            File::delete('img/glossaries/' . $glossary->image);
        }

        $glossary->glossary         = ucfirst($input['glossary']);
        $glossary->slug             = ucfirst($input['slug']);
        $glossary->description      = $input['description'];
        $glossary->image            = $glossary_image;
        $glossary->save();

        $this->setFlash( 'success', "Le mot vient d'être modifié" );
        return $this->show();
    }

    public function remove($id_glossary)
    {
        if(Glossary::where('id', '=', $id_glossary)->delete())
        {
            $this->setFlash( 'success', "Le mot vient d'être supprimé du lexique" );
        }
        else
        {
            $this->setFlash( 'error', "Impossible de supprimer ce mot du lexique" );
        }

        return back();
    }
}
