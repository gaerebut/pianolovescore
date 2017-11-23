<?php

namespace App\Models;

use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use Searchable;
    use SoftDeletes;

    protected $dates = ['created_at', 'deleted_at'];
    protected $table = 'authors';

    public function toSearchableArray()
    {
        return array_only($this->toArray(), ['fullname', 'description']);
    }

    public function scores()
    {
        return $this->hasMany('App\Models\Score')->orderBy('title');
    }

    public function __toString()
    {
    	return $this->lastname;
    }
}
