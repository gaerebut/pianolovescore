<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminMasterController as BaseController;
use Auth;
use Redirect;
use Validator;

class HomeController extends BaseController
{
    public function show()
    {
		return view( 'admin.index' );
    }

    public function login()
    {
    	if( Auth::check() )
		{
			return redirect()->route( 'admin' );
		}
		
		return view( 'admin.login' );
    }

    public function connect( Request $request )
	{
		if( Auth::check() )
		{
			return redirect()->route( 'admin' );
		}

		$validation = Validator::make( $request->all(), [
        	'username'	=> 'required',
            'password'  => 'required'
        ], [
        	'username.required'	=> 'Merci de renseigner un identifiant.',
        	'password.required'	=> 'Merci de renseigner un mot de passe.'
        ] );

        if( !$validation->fails() && Auth::attempt(
			[
				'username' 		=> $request->username,
				'password' 		=> $request->password,
				'deleted_at'	=> null,
				'is_admin'		=> true
			],
			isset( $request->remember )
		) )
        {
        	return redirect()->route( 'admin' );
		}
	   	
	   	$this->setFlash( 'error', 'Erreur lors de la connexion - Veuillez réessayer.' );
	    return redirect()->route( 'admin_login' )
        		-> withErrors( $validation )
        		-> withInput();
	}

	public function disconnect()
	{
		Auth::logout();
		$this->setFlash( 'success', 'Vous venez de vous déconnecter' );
		return redirect()->route( 'admin_login' );
	}
}
