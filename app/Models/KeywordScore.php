<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeywordScore extends Model
{
	public $timestamps = false;
    protected $table = 'keywords_scores';

    public function keyword()
    {
        return $this->belongsTo('App\Models\Keyword');
    }

    public function score()
    {
        return $this->belongsTo('App\Models\Score');
    }
}
