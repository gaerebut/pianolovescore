<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $table = 'keywords';

    public function scores()
    {
        return $this->belongsToMany('App\Models\Score', 'keywords_scores');
    }

    public function __toString()
    {
    	return $this->keyword;
    }
}
