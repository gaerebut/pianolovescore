<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use SoftDeletes;
    protected $dates = ['created_at', 'modified_at', 'deleted_at'];
    protected $table = 'scores';

    public function author()
    {
        return $this->belongsTo('App\Models\Author');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function scoresRequests()
    {
        return $this->hasMany('App\Models\ScoreRequest');
    }

    public function keywords()
    {
        return $this->belongsToMany('App\Models\Keyword', 'keywords_scores');
    }

    public function __toString()
    {
        return $this->title;
    }
}