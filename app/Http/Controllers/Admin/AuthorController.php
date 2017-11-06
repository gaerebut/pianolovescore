<?php
namespace App\Http\Controllers\Admin;

use App\Models\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    public function show()
    {
    	$authors = Author::orderBy('lastname')->get();

    	return view('admin.author.index', [
    		'breadcrumb_last_level' => 'Auteurs',
            'authors'				=> $authors
        ]);
    }
}
