<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminMasterController as BaseController;

class TipController extends BaseController
{
    public function show()
    {
    	return view('admin.tip.index', [
    		'breadcrumb_last_level' => 'Astuces'
        ]);
    }
}
