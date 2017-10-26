<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'scores';

    public function author()
    {
        return $this->belongsTo('App\Models\Author');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function keywords_scores()
    {
        return $this->hasMany('App\Models\KeywordScore');
    }
}