<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'authors';

    public function scores()
    {
        return $this->hasMany('App\Models\Score')->orderBy('title');
    }

    public function __toString()
    {
    	return $this->lastname;
    }
}
