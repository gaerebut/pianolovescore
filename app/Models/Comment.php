<?php

namespace App\Models;

use App\Scopes\IsOnlineScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $dates = ['created_at', 'modified_at', 'deleted_at'];
    protected $table = 'comments';

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new IsOnlineScope);
    }
    
    public function score()
    {
        return $this->belongsTo('App\Models\Score');
    }

    public function trick()
    {
        return $this->belongsTo('App\Models\Trick');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Comment', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Comment', 'parent_id');
    }

    public function __toString()
    {
        return $this->comment;
    }
}
