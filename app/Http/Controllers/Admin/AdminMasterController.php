<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use Session;
use Auth;

class AdminMasterController extends BaseController
{    
    final protected function setFlash( $type, $message )
	{
		$messages = array_merge( ( array )Session::get( $type, [] ), [$message] );
		Session::flash( $type, $messages );
	}
}
