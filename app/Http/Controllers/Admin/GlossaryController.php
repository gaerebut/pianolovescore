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

    	$glossaries = Glossary::where('glossary_fr', 'like', $letter . '%')->orderBy('id')->get();

    	return view('admin.glossary.index', [
    		'breadcrumb_last_level' => 'Lexique en ' . $letter,
            'letter'                => $letter,
            'glossaries'			=> $glossaries
        ]);
    }

    public function add(Request $request)
    {
    	$request->validate([    
            'glossary_fr'      => 'required',
            'glossary_en'      => 'required',
            'description_fr'   => 'required',
            'description_en'   => 'required',
            'slug_fr'          => 'required|unique:glossaries,slug_fr',
            'slug_en'          => 'required|unique:glossaries,slug_en'
        ],[
            'glossary_fr.required'      => 'Veuillez indiquer le mot français à ajouter au lexique',
            'glossary_en.required'      => 'Veuillez indiquer le mot anglais à ajouter au lexique',
            'description_fr.required'   => 'Veuillez mettre une description française pour ce mot',
            'description_en.required'   => 'Veuillez mettre une description anglaise pour ce mot',
            'slug_fr.required'          => 'Veuillez indiquer l\'identifiant URL en français',
            'slug_en.required'		    => 'Veuillez indiquer l\'identifiant URL en anglais',
            'slug_fr.unique'            => 'Cet identifiant URL en français existe déjà, veuillez en choisir un autre',
            'slug_en.unique'		    => 'Cet identifiant URL en anglais existe déjà, veuillez en choisir un autre',
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
        $glossary->glossary_fr         = ucfirst($input['glossary_fr']);
        $glossary->glossary_en         = ucfirst($input['glossary_en']);
        $glossary->slug_fr             = ucfirst($input['slug_fr']);
        $glossary->slug_en             = ucfirst($input['slug_en']);
        $glossary->description_fr      = $input['description_fr'];
        $glossary->description_en      = $input['description_en'];
        $glossary->image            = $glossary_image;
        $glossary->save();

        $this->setFlash( 'success', "Le mot vient d'être ajouté au lexique" );
        return $this->show();
    }

    public function edit(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'glossary_fr'      => 'required',
            'glossary_en'      => 'required',
            'description_fr'   => 'required',
            'description_en'   => 'required',
            'slug_fr'          => 'required|unique:glossaries,slug_fr,' . $input['id'],
            'slug_en'          => 'required|unique:glossaries,slug_en,' . $input['id']
        ],[
            'glossary_fr.required'      => 'Veuillez indiquer le mot français à ajouter au lexique',
            'glossary_en.required'      => 'Veuillez indiquer le mot anglais à ajouter au lexique',
            'description_fr.required'   => 'Veuillez mettre une description française pour ce mot',
            'description_en.required'   => 'Veuillez mettre une description anglaise pour ce mot',
            'slug_fr.required'          => 'Veuillez indiquer l\'identifiant URL en français',
            'slug_en.required'          => 'Veuillez indiquer l\'identifiant URL en anglais',
            'slug_fr.unique'            => 'Cet identifiant URL en français existe déjà, veuillez en choisir un autre',
            'slug_en.unique'            => 'Cet identifiant URL en anglais existe déjà, veuillez en choisir un autre',
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
        else if($glossary->slug_fr != $input['slug_fr'])
        {
            $extension = explode('.', $glossary->image); // extension of existing image file
            $glossary_image = $input['slug_fr'] . '.' . $extension[count($extension)-1];

            File::move('img/glossaries/' . $glossary->image, 'img/glossaries/' . $glossary_image);
        }
        else if(isset($input['delete_image']) && is_file('img/glossaries/' . $glossary->image))
        {
            File::delete('img/glossaries/' . $glossary->image);
        }

        $glossary->glossary_fr         = ucfirst($input['glossary_fr']);
        $glossary->glossary_en         = ucfirst($input['glossary_en']);
        $glossary->slug_fr             = ucfirst($input['slug_fr']);
        $glossary->slug_en             = ucfirst($input['slug_en']);
        $glossary->description_fr      = $input['description_fr'];
        $glossary->description_en      = $input['description_en'];
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
