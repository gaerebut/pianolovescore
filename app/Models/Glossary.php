<?php

namespace App\Models;

use Laravel\Scout\Searchable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Glossary extends Model
{
    use Searchable;

    protected $dates = ['created_at','modified_at',];
    protected $table = 'glossaries';

    public function toSearchableArray()
    {
        return array_only($this->toArray(), ['glossary_fr']);
    }

    public function __toString()
    {
    	return $this->glossary_fr;
    }
}
